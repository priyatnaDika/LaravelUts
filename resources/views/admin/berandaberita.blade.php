<x-template-layout>
    <h1 class="text-3xl text-black pb-6"> Berita Game </h1>
    <div>
        <div class="shadow px-6 py-4 bg-white rounded sm:px-1 sm:py-1 ">
            <div class="grid grid-cols-12">
                <div class="col-span-6 p-4">
                    <a href="{{route('berita.create')}}"><button
                            class="px-4 py-1 text-sm rounded text-black-400 font-semibold border border-black-200 hover:text-black hover:bg-green-400 hover:border-transparent focus:outline-none">
                            Tambah Berita</button>
                    </a>
                </div>
                <div class="col-span-6 p-4 flex justify-end">
                    <form class="form-inline my-2 my-lg-0" type="get" action="/cari">
                        <input placeholder="Judul" type="search" name="search" placeholder="Search"
                            class="px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 rounded-none rounded-1-md sm:text-sm border-gray-300">
                        <button
                            class="rounded-r-md border border-1-0 px-4 py-1 border-gray-300 bg-gray-50 text-gray-500 text-black hover:text-white hover:bg-blue-600"
                            type="submit" class="btn btn-primary mb-2">Cari!</button>
                    </form>

                </div>
                <!-- <nav class="navbar navbar-light">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="form-group mx-sm-3 mb-2 flex justify-end">
                                <form action="/cari" method="get">
                                    <input placeholder="Judul" type="search" name="search" placeholder="Search"
                                        class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none">
                                    <button
                                        class="rounded-r-md border border-1-0 px-4 py-1 border-gray-300 bg-gray-50 text-gray-500 text-black hover:text-white hover:bg-blue-600"
                                        type="submit" class="btn btn-primary mb-2">Cari!</button>
                                </form>
                            </div>

                        </div>
                </nav> -->

            </div>
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg m-3 ">

                <table height="300px" class="min-w-full divide-y divide-gray-200 p-6">

                    <thead class="bg-red-800">
                        <tr class="text-lg text-left  text-white px-2">
                            <th class="w-1 m-3">Tandai</th>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Genre</th>
                            <th>Keterangan</th>
                            <th class="px-8">Cover</th>
                            <th>Aksi</th>
                        </tr>

                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php  $no = 1;?>
                        @foreach ($berita as $item)
                        <tr>
                            <td><input type="checkbox" name="" id=""></td>
                            <td>{{$no}}</td>
                            <td>{{$item->title}}</td>
                            <td>{{$item->genre->genre}}</td>
                            <td>{{$item->description}}</td>
                            <td>
                                <img src="{{asset('storage/'.$item->cover)}}" class="w-16" alt="">
                            </td>
                            <td>

                                <form action="{{route('berita.destroy',$item->id)}}" method="POST" class="px px-8">
                                    @csrf
                                    @method('Delete')
                                    <a href="{{route('berita.edit',$item->id)}}"
                                        class="btn btn-xs p-2 rounded text-black-400 font-semibold border border-black-200  m-3 hover:bg-blue-400 hover:text-black hover:border-transparent focus:outline-none">Edit</a>
                                    <button type="submit"
                                        class="btn btn-xs p-2 rounded text-black-400 font-semibold border border-black-200  m-3 hover:bg-red-400 hover:text-black hover:border-transparent focus:outline-none">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php $no++; ?>
                        @endforeach

                    </tbody>
                </table>
                <tr>

                </tr>
            </div>
        </div>
    </div>
</x-template-layout>