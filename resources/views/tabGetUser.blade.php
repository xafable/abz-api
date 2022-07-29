

<div class="d-flex justify-content-center mt-3">
    <div class="input-group mb-3">
        <input  id="userId" type="text" class="form-control" placeholder="User id" >
        <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="getUser()">Load Info</button>
    </div>
</div>
<div  class="d-flex justify-content-center mt-3" >
    <div id="userContainer" class="card border-info mb-3" style="max-width: 18rem;" hidden>
        <div class="card-header">
            <img id="user_image" src="..." class="card-img-top" alt="...">
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item" id="user_id"></li>
                <li class="list-group-item" id="user_name"></li>
                <li class="list-group-item" id="user_email"></li>
                <li class="list-group-item" id="user_phone"></li>
                <li class="list-group-item" id="user_position"></li>
                <li class="list-group-item" id="user_position_id"></li>
            </ul>
        </div>
    </div>
</div>




