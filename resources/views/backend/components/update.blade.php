<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#update{{$image->id}}">
    Update Image
</button>

<!-- Modal -->
<div class="modal fade" id="update{{$image->id}}" tabindex="-1" aria-labelledby="update{{$image->id}}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="update{{$image->id}}Label">Update Image</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route("images.update" , $image->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div>
                        <label for="name">Enter name of image</label>
                        <input class="rounded-pill -bottom-3" type="text" name="name" id="name" value="{{old("name" , $image->name)}}" required>
                    </div>
                    <div>
                        <label for="desc">Enter desc of image</label>
                        <input class="rounded-pill -bottom-3" type="text" name="desc" id="desc" value="{{old("desc" , $image->desc)}}" required>
                    </div>
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active btnEmpty" id="pills-url{{$image->id}}-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-url{{$image->id}}" type="button" role="tab" aria-controls="pills-url{{$image->id}}"
                                aria-selected="true">url</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link btnEmpty" id="pills-file{{$image->id}}-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-file{{$image->id}}" type="button" role="tab"
                                aria-controls="pills-file{{$image->id}}" aria-selected="false">file</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-url{{$image->id}}" role="tabpanel"
                            aria-labelledby="pills-url{{$image->id}}-tab" tabindex="0">
                            <label for="srcUrl">Mettre un url</label>
                            <input class="inputEmpty" type="url" name="srcUrl" id="srcUrl">
                        </div>
                        <div class="tab-pane fade" id="pills-file{{$image->id}}" role="tabpanel"
                            aria-labelledby="pills-file{{$image->id}}-tab" tabindex="0">
                            <label for="srcFile">Mettre un file</label>
                            <input class="inputEmpty" type="file" name="srcFile" id="srcFile">
                        </div>
                    </div>
                    <button class="btn btn-success rounded-pill ps-2 pe-2" type="submit">Update your Image</button>
                </form>
            </div>
        </div>
    </div>
</div>
