<?php

namespace api\v1;
use Carbon\Carbon;
use GameEvent;
use Item;
use Admin;
use ItemsDistribution;
use Location;
use SpawnedItem;
use User;
use UserTracking;
use Input;
class ItemsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index() {
		$eventWithItems = GameEvent::with('items')->get();
		return $eventWithItems;
	}

	public function getEventItems($codeName = '')
	{
		if ($codeName != '') {
			$codeNameArr = explode(',', $codeName);
			$eventWithItems = GameEvent::with('items')->whereIn('codename', $codeNameArr)->get();
			
			return $eventWithItems;
		} else {
			// Return list all events
			$eventWithItems = GameEvent::with('items')->get();
			return $eventWithItems;
		}

		return '';
	}

	public function getLocationItems($userid = '', $locationId = '')
	{
		if ($locationId != '') {
			$locationIdArr = explode(',', $locationId);
			$locationWithItems = Location::with('itemDistributions')->whereIn('id', $locationIdArr)->get();
			return $locationWithItems;
		} else {
			$locationWithItems = Location::with(
				array(
					'itemDistributions.item', 
					'itemDistributions.item.spawnedItems'=>function($query) use ($userid) {
						$query->where('user_id', $userid)->where('status', 1);	
					})
				)->get();
			return $locationWithItems;
		}
		return '';
	}

	public function getSpawn($count, $userId, $lat, $lng)
	{
		$locations = Location::all()->toArray();
		if ($lat != '' && $lng != '') {
			$nearest = NULL;
			$nearestDistance = 0;
			foreach ($locations as $location) {
				$distance = $this->distance((float)$lat, (float)$lng, $location['latitude'], $location['longitude'], 'K'); //Kilometer distance
				if ($distance <= $location['radius']) {
					if ($nearest == NULL) {
						$location['distance'] = $distance;
						$nearest = $location;
						$nearestDistance = $distance;
					} else {
						if ($distance < $nearestDistance) {
							$location['distance'] = $distance;
							$nearest = $location;
							$nearestDistance = $distance;
						}
					}
				}
			}
			
			// Not nearest any location
			if ($nearest == NULL) {
				// random card 1: 70%, card 2: 30%
				$rand = mt_rand(1, 10);
				
				if ($rand <= 7) {
					// spawn two fake card 1
					$spawnedItemArr = array();
					array_push($spawnedItemArr, array('fake'=>1, 'coupon_code'=>uniqid(), 'item'=>array('file'=>'Card-1.png', 'visible_time'=>60)));
					array_push($spawnedItemArr, array('fake'=>1, 'coupon_code'=>uniqid(), 'item'=>array('file'=>'Card-1.png', 'visible_time'=>60)));
					return json_encode($spawnedItemArr, JSON_UNESCAPED_UNICODE);
				} else {
					// spawn two fake card 2
					$spawnedItemArr = array();
					array_push($spawnedItemArr, array('fake'=>1, 'coupon_code'=>uniqid(), 'item'=>array('file'=>'Card-2.png', 'visible_time'=>60)));
					array_push($spawnedItemArr, array('fake'=>1, 'coupon_code'=>uniqid(), 'item'=>array('file'=>'Card-2.png', 'visible_time'=>60)));
					return json_encode($spawnedItemArr, JSON_UNESCAPED_UNICODE);
				}

				return ''; // never reach here
			}

			// Get all item distribution at that nearest location
			//$itemDistributions = ItemsDistribution::with('item')->where('location_id', $nearest['id'])->get()->toArray();
			$itemDistributions = ItemsDistribution::with(array('item' => function($query) {
				$query->where('current_quantity', '>', 0);
			}))->where('location_id', $nearest['id'])->get()->toArray();

			$totalProbability = 0;
			foreach($itemDistributions as $itemDistribution) {
				if ($itemDistribution['item'] != null) {
					$totalProbability += $itemDistribution['percentage'];
				}
			}

			if ($totalProbability < 1) return '';

			//random number from 1 to $totalProbability
			$randArr = array();
			for ($i=0; $i<$count; $i++) {
				$rand = mt_rand(1, $totalProbability);
				array_push($randArr, $rand);
			}
			$sum = 0;
			$selectedItemIds = array();
			$selectedItems = array();

			foreach ($randArr as $rand) {
				$sum = 0;
				foreach ($itemDistributions as $itemDistribution) {
					if ($itemDistribution['item'] != null) {
						$sum += $itemDistribution['percentage'];
						if ($rand <= $sum) {
							array_push($selectedItemIds, $itemDistribution['item_id']);
							array_push($selectedItems, $itemDistribution['item']);
							break;
						}
					}
				}
			}

			//save that item in to spawned_items table, each item valid for 1 hour
			$spawnedItemArr = array();
			$len = count($selectedItems);
			for ($i=0; $i<$len; $i++) {
				$selectedItemId = $selectedItemIds[$i];
				$selectedItem = $selectedItems[$i];
				$spawnedItem = SpawnedItem::create(array(
					'item_id' => $selectedItemId,
					'location_id' => $nearest['id'],
					'user_id' => $userId,
					'coupon_code' => uniqid(),
					'valid_from' => Carbon::now(),
					'valid_until' => Carbon::now()->addHours(1),
					'created_at' => Carbon::now()
				));
				$spawnedItem->item = $selectedItem;
				$spawnedItem->location = $nearest;
				array_push($spawnedItemArr, $spawnedItem->toArray());
			}
			return json_encode($spawnedItemArr, JSON_UNESCAPED_UNICODE);

		}

		return '';
	}

	public function getReceive($userId, $couponCode, $lat, $lng) {
		if ($userId == '' || $couponCode == '') return;
		// get that coupon code
		$receivedItemModel = SpawnedItem::where('coupon_code', $couponCode)->get();
		$spawnedItems = $receivedItemModel->toArray();
		if (count($spawnedItems) <= 0) return 'No coupon found!';
		$receivedItem = $spawnedItems[0];
		if ($receivedItem['user_id'] != $userId) return 'Coupon not belong to you!';
		if ($receivedItem['status'] != 0) return 'This coupon already received!';

		$itemToSave = $receivedItemModel->first();
		$itemToSave->status = 1;
		$itemToSave->save();
		$userTracking = UserTracking::create(array(
				'spawned_item_id' => $receivedItem['id'],
				'item_found_at' => Carbon::now(),
				'found_at_latitude' => (float)$lat,
				'found_at_longitude' => (float)$lng,
				'created_at' => null,
			));

		//decrease item quantity
		$itemId = $itemToSave->item_id;
		$items = Item::where('id', $itemId)->get();
		$item = $items->first();
		if ($item != NULL) {
			$item->current_quantity = $item->current_quantity - 1;
			$item->save();
		}

		return $userTracking;
	}

	public function getMyItems($userId) {
		if ($userId == '') return;
		$myItems = Item::with(array('spawnedItems' => function($query) use ($userId)
			{
				$query->where('user_id', $userId)->where('status', 1);
			}, 'spawnedItems.location', 'gameEvent'))->orderBy('event_id')->get();

		return $myItems;
	}

	function distance($lat1, $lon1, $lat2, $lon2, $unit) {
		$theta = $lon1 - $lon2;
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;
		$unit = strtoupper($unit);
		if ($unit == "K") {
		return ($miles * 1.609344);
		} else if ($unit == "N") {
		return ($miles * 0.8684);
		} else {
		return $miles;
		}
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('items.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('items.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('items.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
