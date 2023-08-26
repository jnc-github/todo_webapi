getAll();

document.querySelector(".btn-refresh").addEventListener("click", () => {
    getAll();
});

document.querySelector(".btn-add").addEventListener("click", () => {
    let title = document.querySelector("#form-add input[name='title']").value;
    console.log(title);
    add(title);
    document.querySelector("#form-add input[name='title']").value = "";
});

document.querySelector(".btn-update").addEventListener("click", () => {
    let index = document.querySelector("#form-update input[name='index']").value;
    let title = document.querySelector("#form-update input[name='title']").value;
    let status = document.querySelector("#form-update input[name='status']").value;
    console.log(index);
    console.log(title);
    console.log(status);
    updateOneById(index, title, status);
});

document.querySelector(".btn-delete").addEventListener("click", () => {
    let index = document.querySelector("#form-delete input[name='index']").value;
    console.log(index);
    deleteOneById(index);
    document.querySelector("#form-delete input[name='index']").value = "";
});