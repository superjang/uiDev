@extends('layouts.base')

@section('content')
    <ul class="tabs tab-demo z-depth-1">
        <li class="tab"><a target="_self" href="{{ route('images.generateForm') }}">Generate</a></li>
        <li class="tab"><a target="_self" href="{{ route('images.uploadForm') }}">Upload</a></li>
        <li class="tab"><a target="_self" class="active" href="{{ route('images.collection', ['imageAddedType' => 'generated'])  }}">List</a></li>
    </ul>

    <ul class="tabs tab-demo z-depth-1">
        <li class="tab"><a target="_self" href="{{ route('images.collection', ['imageAddedType' => 'generated']) }}">Generate List</a></li>
        <li class="tab"><a target="_self" href="{{ route('images.collection', ['imageAddedType' => 'upload']) }}">Upload List</a></li>
    </ul>

    <ul class="image-list">
    @forelse($data as $item)
        <li class="image-item">
            <a href="{{ $item->request_path }}" target="_blank" class="image-thumbnail" style="background-image:url({{ $item->request_path }});"></a>
            <div class="image-info">
                <a href="{{ $item->request_path }}" target="_blank" class="image-url">
                    <p class="text usage">{{ $item->site }}의 {{ $item->service }} 에서 사용됩니다.</p>
                    <p class="text request_url">URL : {{ $item->request_path }}</p>
                    <p class="text file-name">{{ $item->file_name }}</p>
                </a>
                <a href="{{ route('images.destroy', ['image_added_type'=>$item->image_added_type, 'destory_key' => $item->request_path]) }}" class="delete-image">
                    <i class="material-icons dp48">delete</i>
                </a>
            </div>
        </li>
    @empty
        <li>empty directory</li>
    @endforelse

    </ul>

    @if($data->count())
        {!! $data->render('common.pagination') !!}
    @endif

    {{--<script>--}}
        {{--var UXE = @json($data);--}}
    {{--</script>--}}
@endsection