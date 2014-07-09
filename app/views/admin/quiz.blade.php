@extends('admin.master')

@section('javascript_tag')
<?= javascript_include_tag('admin/application', ['data-page' => 'quizcontest.create']) ?>
@stop

@section('current_app')
<a href="#" class="dropdown-toggle" data-toggle="dropdown">Quiz Contest <b class="caret"></b></a>
@stop

@section('title')

@stop

@section('breadcumb')
<ul class="breadcrumb">
  <li class="active">Home</li>
</ul>
@stop

@section('create-quiz')
<div id='create-quiz'>
    <form class="form-horizontal" id='form-create-quiz'>
      <fieldset id='legend-quiz-create'>
        <legend>Chủ đề</legend>
        <div class="form-group">
          <label for="inputTitle" class="col-lg-2 control-label">Tiêu đề</label>
          <div class="col-lg-10">
            <input type="text" class="form-control" id="inputTitle" placeholder="Tiêu đề">
          </div>
        </div>
        <div class="form-group">
          <label for="textArea" class="col-lg-2 control-label">Mô tả</label>
          <div class="col-lg-10">
            <textarea class="form-control" rows="3" id="description"></textarea>
            <span class="help-block">Mô tả chi tiết của sự kiện.</span>
          </div>
        </div>
        <div class="form-group">
          <label for="textArea" class="col-lg-2 control-label">Privacy</label>
          <div class="col-lg-10">
            <textarea class="form-control" rows="3" id="description"></textarea>
            <span class="help-block">Privacy of this event.</span>
          </div>
        </div>
        <div class="form-group">
          <label for="textArea" class="col-lg-2 control-label">Luật và điều khoản</label>
          <div class="col-lg-10">
            <textarea class="form-control" rows="3" id="description"></textarea>
            <span class="help-block">Luật và điều khoản của sự kiện.</span>
          </div>
        </div>

        <div class="form-group">
          <label class="col-lg-2 control-label">Radios</label>
          <div class="col-lg-10">
            <div class="radio">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                Option one is this
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                Option two can be something else
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="select" class="col-lg-2 control-label">Selects</label>
          <div class="col-lg-10">
            <select class="form-control" id="select">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
            <br>
            <select multiple="" class="form-control">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">
            <button class="btn btn-default">Cancel</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </fieldset>
    </form>
</div>
@stop

@section('content')
<div class='col-lg-10' id='content'>
@if (count($quizs) > 0)
    <div id='table-quizs'>
        <table class="table table-striped table-hover ">
          <thead>
            <tr>
              <th>#</th>
              <th>Chủ đề</th>
              <th>Trạng thái</th>
              <th>Ngày cập nhật</th>
              <th>Ngày tạo</th>
            </tr>
          </thead>
          <tbody>
            <?php $count=1; ?>
            @foreach ($quizs as $quiz)
            <tr>
                <td>{{$count}}</td>
                <td>{{$quiz->title}}</td>
                <td>{{$user->description}}</td>
                <td>{{$user->updated_at}}</td>
                <td>{{$user->created_at}}</td>
            </tr>
            <?php $count++ ?>
            @endforeach
          </tbody>
        </table>
    </div>
@else
    <fieldset id='legend-quiz-empty'>
        <legend>Chủ đề</legend>
        <p class="text-muted">Bạn chưa có chủ đề nào.</p>
    </fieldset>
    <button id="button-create-quiz" type="button" class="btn btn-primary">Tạo chủ đề mới</button>
    @yield('create-quiz')
@endif
</div>
@stop
