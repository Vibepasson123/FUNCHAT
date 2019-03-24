@extends('layouts.app')

@section('content')
<link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">


<style>
.list-group{
    height: 400px;
    overflow-y: scroll;
    .list-group-item {
        font-size: medium;
    }



}
::-webkit-scrollbar {
    width: 0px;
    background: transparent;
}
.card-header{
    background-image: linear-gradient(to right top, #000000, #1d191a, #322b2d, #4a3e42, #625259, #685860, #6f5f68, #75656f, #6b5e66, #62575e, #585055, #4f494d);
    border-bottom: 1px solid rgba(31, 27, 27, 0.82);
    margin-bottom: 1.0rem;

}
.card{
    background-image:url(../image/testing.png);
}
.chatHeader{
color: black;
font-weight: 900;
font-family: sans-serif;
}




</style>
<div class="container" id="groupChat">


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" id="app">
                <div class="card-header chatcard" > <h4 class="chatHeader">Chat-Box {{--  <small class="badge-pill badge-danger">@{{ listOfUsers }}</small> --}}<a  href="" class="fa fa-trash pull-right " @click.prevent='clearchat' aria-hidden="true"></a></h4>
                    <div class="dropdown">
                            <button type="button" id="privateBtn" class="btn btn-secondary">Private-Message</button>
                            <button class="btn btn-secondary pull-right dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <small class="badge-pill badge-danger">@{{ listOfUsers }}</small>  Current User
                            </button>
                            <div class="dropdown-menu" aria-labelledby="Current User">
                             <userlist v-for="value,index in userlists"
                             :key=value.index
                             >@{{ value.name }}

                             </userlist>

                            </div>
                          </div></div>
                <div class="badge badge-pill badge-primary">@{{ typing }}</div>
                <ul class="list-group"  v-chat-scroll >

                         {{-- <li class="list-group-item active">@{{userlist}}</li> --}}
                       <message
                       v-for="value,index in chatmessage.message"
                        :key=value.index
                         :color=chatmessage.color[index]
                         :user=chatmessage.user[index]
                         :time=chatmessage.time[index]
                       > @{{ value }}
                        </message>

                      </ul>
                      <input  type="text" cols="4" rows="4" class="form-control" placeholder="Type Your Message......" v-model="message"  @keyup.enter="send"></input>


            </div>


        </div>
    </div>

</div>
<div class="container" id="privateChat">

        <div class="row justify-content-center">

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header"><h3 class="chatHeader">Private Chat </h3>  <button type="button" id="groupBTN" class="btn btn-secondary pull-right">Group-Message</button></div>

                    <div class="card-body" id="app2">
                        <chatapp :user="{{ auth()->user() }}"></chatapp>
                    </div>
                </div>
            </div>
        </div>

  <script>
        $(document).ready(function() {
            $('#privateChat').hide();
            $("#privateBtn").click(function(){
                $('#groupChat').hide();
                $('#privateChat').show();
              });
              $("#groupBTN").click(function(){

                $('#privateChat').hide();
                $('#groupChat').show();
              });

         });



</script>


@endsection
