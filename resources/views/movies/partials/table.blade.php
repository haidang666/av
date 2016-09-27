<input type="hidden" id="inactionMovie" value="">
<div class="box box-info">
    <div class="box-body">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th style="width: 2%">ID</th>
                <th>Thumbnail</th>
                <th>Name</th>
                <th>Code</th>
                <th>Studio</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if($movies->total() == 0)
                <tr>
                    <td colspan="5">No such thing here</td>
                </tr>
            @endif
            @foreach($movies as $movie)
                <tr>
                    <td>{{$movie->id}}</td>
                    <td><img width="130px" height="160px" src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=120" /></td>
                    <td>{{$movie->name}}</td>
                    <td>{{$movie->code}}</td>
                    <td>{{$movie->studio_id}}</td>
                    <td>
                        <button type="button" class="btn-link clear-padding btn-edit-movie" data-id="{{$movie->id}}">
                            <i class="fa fa-pencil"></i></button>
                        <button type="button" class="btn-link clear-padding text-red btn-delete-movie" data-id="{{$movie->id}}">
                            <i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer clearfix">
        {{$movies->render()}}
    </div>
</div>