<div class="form-group mt-7">  
    <label for="title">Title</label>
    <input type="text" id="title" name="title" value="{{old('title', optional($post ?? null)->title)}}" class="form-control">
</div>
{{-- @error('title')
<div class="alert alert-danger">{{$message}}</div>
@enderror --}}
    <br />
    <div class="form-group">
        <label for="content">Content</label>
        <textarea id="content" name="content" class="form-control">{{old('content', optional($post ?? null)->content)}} </textarea>
    </div>
    <div class="form-group mt-4">
        <label for="image">Thumbnail</label>
        <br />
        <input type="file" id="image" name="thumbnail" class="form-control-file mb-4"></input>
    </div>
   <x-errors></x-errors>