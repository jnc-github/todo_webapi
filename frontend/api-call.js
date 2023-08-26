function clickRow(item){
    return function(){
        console.log(item.getAttribute("item-id"));
        console.log(item.getAttribute("item-title"));
        console.log(item.getAttribute("item-status"));
    
        // for update form
        let formUpdateIndex = document.querySelector("#form-update input[name='index']");
        formUpdateIndex.value = item.getAttribute("item-id");
    
        let formUpdatetitle = document.querySelector("#form-update input[name='title']");
        formUpdatetitle.value = item.getAttribute("item-title");
    
        let formUpdateStatus = document.querySelector("#form-update input[name='status']");
        formUpdateStatus.checked = item.getAttribute("item-status") == "0" ?false:true;
        
        // for delete form
        let formDeleteIndex = document.querySelector("#form-delete input[name='index']");
        formDeleteIndex.value = item.getAttribute("item-id");
    
    
        // for highlighting the selected row
        let itemElements = document.querySelectorAll("#main-list tbody tr");
        for (let i = 0; i < itemElements.length; i++) {
            itemElements[i].removeAttribute("selected");
        }
        item.setAttribute("selected", "");
    }
  
};

function refreshTodoList(todoList){
    console.log(todoList);
    // step 1: empty the current table 
    let bodyNode = document.querySelector("table#main-list tbody");
    bodyNode.innerHTML = "";

    // step 2: build new items using row tempalte and append to bodyNode
    let templateNode = document.getElementById("template-item-row");
    for (const index in todoList) {
        console.log(index);
        console.log(todoList[index]);
        var node = templateNode.content.cloneNode(true);
        node.querySelector("td.index").innerHTML = index;
        node.querySelector("td.title").innerHTML = todoList[index]["title"];
        node.querySelector("td.status input").checked = todoList[index]["status"];
        var newRow = node.querySelector("tr");
        newRow.setAttribute("item-id", index);
        newRow.setAttribute("item-title", todoList[index]["title"]);
        newRow.setAttribute("item-status", todoList[index]["status"]);
        newRow.onclick = clickRow(newRow);
        bodyNode.appendChild(newRow);
    }
}

function getAll(){
    fetch("https://jnc-github.github.io/api/get-all.php")
    // fetch("http://localhost:8017/Cloud_Lesson8_Web_API_Basic_Tutorial14_ToDoList/todo/webapi_2/api/get-all.php")
        .then((res) => res.json())
        .then((data) => {
            console.log(data);
            if(data["result"]){
                refreshTodoList(data["todo-list"]);
            }
        })
        .catch((error) => {
            console.log(error);
        });
}

function getOneById(index){
    fetch("../api/get-one-by-id.php",{
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            "index": index
        }),
    })
        .then((res) => res.json())
        .then((data) => {
            console.log(data);
        })
        .catch((error) => {
            console.log(error);
        });
}

function add(title){
    fetch("../api/add.php",{
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            "title": title
        }),
    })
        .then((res) => res.json())
        .then((data) => {
            console.log(data);
            if(data["result"]){
                refreshTodoList(data["todo-list"]);
            }
        })
        .catch((error) => {
            console.log(error);
        });
}

function updateOneById(index, title, status){
    fetch("../api/update-one-by-id.php",{
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            "index": index,
            "title": title,
            "status": status
        }),
    })
        .then((res) => res.json())
        .then((data) => {
            console.log(data);
            if(data["result"]){
                refreshTodoList(data["todo-list"]);
            }
        })
        .catch((error) => {
            console.log(error);
        });
}

function deleteOneById(index){
    fetch("../api/delete-one-by-id.php",{
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            "index": index
        }),
    })
        .then((res) => res.json())
        .then((data) => {
            console.log(data);
            if(data["result"]){
                refreshTodoList(data["todo-list"]);
            }
        })
        .catch((error) => {
            console.log(error);
        });
}