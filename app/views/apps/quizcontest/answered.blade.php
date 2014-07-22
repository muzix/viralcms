@extends('master')

@section('content')
<script>
    alert("Cám ơn bạn đã tham gia chương trình. Hãy truy cập ứng dụng thường xuyên để trả lời câu đố nhé ^_^")
    window.location.href = "{{{url('/quiz-contest?userId='.$user->id)}}}"
</script>
@stop