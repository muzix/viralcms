<?php

class AdminController extends \BaseController {
    public function showDashboard() {

        $groups = DB::table('invitations')
                ->join('users', 'invitations.from_id', '=', 'users.fbid')
                ->select(array('from_id', DB::raw('COUNT(*) `amount`'), 'username', 'shortname', 'fullname', 'email', 'gender', 'birthday', 'place'))
                ->groupBy('from_id')
                ->orderBy('amount', 'DESC')
                ->get();

        return View::make('admin.dashboard')->with(array("groups"=>$groups));
    }
}