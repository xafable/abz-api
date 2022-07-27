
<form id="user" enctype="multipart/form-data">
    @csrf
    <div  class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Token</span>
        <input id="token" type="text" class="form-control" placeholder="Token" aria-label="Token" aria-describedby="basic-addon1" required>
    </div>

<div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">name</span>
    <input name="name" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
</div>

<div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">email</span>
    <input name="email" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
</div>

<div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">phone</span>
    <input name="phone" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
</div>

<div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">position_id</span>
    <input name="position_id" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
</div>


    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">photo</span>
        <input name="photo" type="file" class="form-control" id="inputGroupFile02">
    </div>

</form>
<button id="postButton" type="button" class="btn btn-info mt-2 mb-3" onclick="postUser()">Post</button>




