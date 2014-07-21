@extends('admin.master')

@section('javascript_tag')
<?= javascript_include_tag('admin/application', ['data-page' => 'answer-list']) ?>
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

@section('content')

    <div id='table-questions' class='col-lg-12'>
        <table class="table table-striped table-hover ">
          <thead>
            <tr>
              <th>#</th>
              <th>Người chơi</th>
              <th>Email</th>
              <th>Trả lời</th>
              <th>Thời gian</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody>
            <?php $count=1; ?>
            @foreach ($answers as $answer)
            <tr>
                <td>{{$count}}</td>
                <td>{{$answer->user->fullname}}</td>
                <td>{{$answer->user->email}}</td>
                <td>{{$answer->answer}}</td>
                <td>{{$answer->updated_at}}</td>
                <td></td>
                {{--
                <td>
                    <button class="btn btn-primary btn-xs button-edit-question" data-question="{{$question->id}}"><i class="fa fa-edit"></i> Sửa </button>
                    <button class="btn btn-danger btn-xs button-delete-question" data-question="{{$question->id}}"><i class="fa fa-trash-o"></i> Xoá </button>
                </td>
            ---}}
            </tr>
            <?php $count++ ?>
            @endforeach
          </tbody>
        </table>
    </div>

@stop
