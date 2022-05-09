@extends("Admin.layout.main")

@section("content")
<style>
    .upload-btn-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;
}

.btn {
  border: 2px solid gray;
  color: gray;
  background-color: white;
  padding: 8px 20px;
  border-radius: 8px;
  font-size: 20px;
  font-weight: bold;
}

.upload-btn-wrapper input[type=file] {
  font-size: 100px;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
}
</style>
@if(Session::has("success"))
<div class="alert alert-success text-center">{{ Session::get('success') }}</div>
@endif
<form action="{{ url('admin/site_logo') }}" enctype="multipart/form-data" method="POST">
    @csrf
<div align="center" class="file-upload-wrapper">
    <h2 class="text-center">Choose site logo</h2>
  <input type="file" class="input form-control m-4" name="file" id="input-file-now" class="file-upload" /><br>
  <button class="btn btn-success" type="submit">Save</button>
</div>
</form>




@endsection

@section("custom-js")

<script>
    $('.file-upload').file_upload();
</script>
@endsection