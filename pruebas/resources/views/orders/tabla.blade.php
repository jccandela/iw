@extends('layout')

@section('cabecera')
<h1 style="margin:2%">Tracks in my cart</h1>
<script src="./js/audio.min.js"></script>
@endsection

@section('contenido')

<script>
  audiojs.events.ready(function() {
    var as = audiojs.createAll();
  });
</script>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="35%">Title</th>
      <th scope="col" width="10%">Artist</th>
      <th scope="col" width="10%">Genre</th>
      <th scope="col" width="10%">BPM</th>
      <th scope="col" width="10%">Key</th>
      <th scope="col" width="10%">Duration</th>
      <th scope="col" width="10%">Download</th>
      <th scope="col" width="5%"></th>
    </tr>
  </thead>
  <tbody>
  <?php
  $tracksCart =  DB::table('tracks')
  ->join('orders', 'tracks.id', '=', 'orders.track_id')
  ->where('user_id', Auth::user()->id)
  ->get();

  $totalprice = 0;
   ?>
  @foreach($tracksCart as $track)
  <tr>
     <td>{{$track->title}} <audio src="./mp3/juicy.mp3" preload="none" ></audio></td>
     <?php
        $artist = $artist = DB::table('artists')
                       ->where('id', $track->artist_id)
                       ->get()->first();
        $aux = str_replace(" ", "_", $artist->name);
        $genre = $genre = DB::table('genres')
                       ->where('id', $track->genre_id)
                       ->get()->first();
      
            
                      
        
      ?>
     <td><a href="{{url('artist')}}/{{$aux}}">{{$artist->name}}</a> </td>
     <?php
        $genre = $genre = DB::table('genres')
                       ->where('id', $track->genre_id)
                       ->get()->first();
      ?>
     <td>{{$genre->name}}</td>
     <td>{{$track->bpm}}</td>
     <td>{{$track->key}}</td>
     <td>{{$track->duration}}</td>
  </tr>
  @endforeach
  </tbody>
</table>
@stop
