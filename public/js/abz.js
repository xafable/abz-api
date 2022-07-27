let usersPage = 1;





function getToken() {
    fetch('http://abz-api/api/token')
        .then(response => response.json())
        .then(data => document.getElementById("tokenInput").value = data.token);
}

async function  getUsers(){
    let data =  await fetch('http://abz-api/api/users' + '?page=' + usersPage,{
        method: 'GET',
        headers: {
            'Authorization' : 'Bearer 17|MdfehWRhYcHZiEGk3JA7g6qlus1gAb1iCxj5dKth',
            'Accept': 'application/json' } })
        .then(response => response.json());

    let newRow = document.createElement("div");
    newRow.className = "row mt-2";

    data.users.forEach(item => {
        card = document.getElementById('cardTemplate').cloneNode(true);
        card.removeAttribute("hidden");
        card.querySelector('#phone').innerHTML = item.phone;
        card.querySelector('#name').innerHTML = item.name;
        card.querySelector('#position').innerHTML = item.position;
        card.querySelector('#email').innerHTML = item.email;
        card.querySelector('#image').src = 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/26/Mark_Wahlberg_2021.jpg/220px-Mark_Wahlberg_2021.jpg';

        let newCol = document.createElement("div");
        newCol.className = "col";
        newCol.appendChild(card);
        newRow.appendChild(newCol);
    });
    document.getElementById('usersContainer').appendChild(newRow);

    usersPage++;
}

async function  getUser(){
    let userId = document.getElementById('userId').value;
    let data =  await fetch('http://abz-api/api/users/' + userId,{
        method: 'GET',
        headers: {
            'Accept': 'application/json' } })
        .then(response => response.json());


    if(data.success){
        showMessage('Loaded');
    }
    console.log(data);


    document.getElementById('user_id').innerHTML = 'id: ' + data.user.id;
    document.getElementById('user_name').innerHTML = 'name: ' + data.user.name;
    document.getElementById('user_email').innerHTML = 'email: ' + data.user.email;
    document.getElementById('user_phone').innerHTML = 'phone: ' + data.user.phone;
    document.getElementById('user_position').innerHTML = 'position: ' + data.user.position;
    document.getElementById('user_position_id').innerHTML = 'position_id: ' + data.user.position_id;

}

async function  getPositions(){
    let data =  await fetch('http://abz-api/api/positions' ,{
        method: 'GET',
        headers: {
            'Accept': 'application/json' } })
        .then(response => response.json());

   // console.log(data);


    //let colCounter = 0;
    newRow = document.createElement("div");
    newRow.className = "row mt-2";
    data.data.forEach( (item,index) => {

        //alert(index);
        console.log(item);

        card = document.getElementById('positionsTemplate').cloneNode(true);
        card.removeAttribute("hidden");

        card.querySelector('#id').innerHTML = item.id;
        card.querySelector('#name').innerHTML = item.name;

        let newCol = document.createElement("div");
        newCol.className = "col";
        newCol.appendChild(card);
        newRow.appendChild(newCol);

        if(index === 0){
            document.getElementById('positionsContainer').appendChild(newRow);
        }
        else if(index%3 === 0 && index > 0){
            newRow = document.createElement("div");
            newRow.className = "row mt-2";
            colCounter = 0;
            document.getElementById('positionsContainer').appendChild(newRow);
        }

        //colCounter++;
    });

    document.getElementById('loadButton').setAttribute("hidden", true);
}

async function  postUser() {
    let userForm = document.getElementById('user');
    let token = document.getElementById('token');
    if(token.value === ""){
        showMessage("Token is Empty!");
        token.focus();
        return false;
    }

    let data =  await fetch('http://abz-api/api/users' ,{
        method: 'POST',
        body: new FormData(userForm),
        headers: {
            'Authorization' : 'Bearer ' + token.value,
            'Accept': 'application/json'
            } });

}

function showMessage(message){

    document.getElementById('toastMessage').innerHTML = message;
    const toastLive = document.getElementById('liveToast')
    const toast = new bootstrap.Toast(toastLive)
    toast.show()
}





