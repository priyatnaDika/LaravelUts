@extends('layout.template')

@sectiom('content')

<table height="300px" class="min-w-full divide-y divide-gray-200 p-2">
    <thead class="bg-blue-600">
        <tr class="text-lg text-left  text-white">
            <th class="w-1 m-3">Tandai</th>
            <th>No</th>
            <th>Judul</th>
            <th>Keterangan</th>
            <th>Cover</th>
            <th>Aksi</th>
        </tr>

    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        <?php  $no=1;?>
        @foreach ($berita as $item)
        <tr>
            <td><input type="checkbox" name="" id=""></td>
            <td>{{$no}}</td>
            <td>{{$item->title}}</td>
            <td>{{$item->description}}</td>
            <td>
                <img src="{{asset('storage/'.$item->cover)}}" class="w-16" alt="">
            </td>
            <td>

                <form action="{{route('berita.destroy',$item->id)}}" method="POST">
                    @csrf
                    @method('Delete')
                    <a href="{{route('berita.edit',$item->id)}}"
                        class="btn btn-xs p-2 rounded text-black-400 font-semibold border border-black-200  m-3 hover:bg-blue-400 hover:text-black hover:border-transparent focus:outline-none">Edit</a>
                    <button type="submit"
                        class="btn btn-xs p-2 rounded text-black-400 font-semibold border border-black-200  m-3 hover:bg-red-400 hover:text-black hover:border-transparent focus:outline-none">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        <?php $no++; ?>
    </tbody>
</table>

@endsection