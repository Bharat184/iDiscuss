let addthread=document.getElementById('addthread');
let postThreadBtn=document.getElementById('postThreadBtn');

let createuser=document.getElementById('createuser');
let userform=document.getElementById("userform");

let postform=document.getElementById('postform');
let createpost=document.getElementById('createpost');

if(addthread && postThreadBtn)
{
    postThreadBtn.addEventListener('click',(e)=>{
        addthread.click();
    });
}

if(userform && createuser)
{
    createuser.addEventListener('click',()=>{
        let pw=document.querySelector('input[name="password"]').value.trim();
        let cpw=document.querySelector('input[name="cpassword"]').value.trim();
        let name=document.querySelector('input[name="username"]').value.trim();
        let email=document.querySelector('input[name="email"]').value.trim();

        if(pw!=cpw)
        {
            alert("Password doesn't match");
        }
       else if(pw.length<1 || name.length<1 || email.length<1){
        alert("Input Field can't be empty!");
       }
        else
        {
            userform.submit();
        }
    })
}

if(postform && createpost)
{
    createpost.addEventListener('click',()=>{

        let title=document.getElementById("title").value.trim();
        let description=document.getElementById("description").value.trim();
        if(title.length<1 || description.length<1)
        {
            alert("Input field cannot be empty!");
        }
        else
        {
            postform.submit();
        }

    });

}

function handlepostdelete(element)
{
    let obj=atob(element.dataset.json);
    obj=JSON.parse(obj);
    let id=btoa(obj.id);
    if(confirm("Are You Sure You Want To Delete?"))
    {
        window.location.href=`./categories.php?name=${obj.cat_name}&del=${id}`;
    }
}

function handlepostedit(element)
{
    let json=atob(element.dataset.json);
    let editmodal=document.getElementById("editmodalbtn");
    let obj=JSON.parse(json);
    editmodal.click();
    let editpostmodal=document.querySelector('.edit-post-modal');
    let editmodaltitle=document.getElementById('edit-modal-title');
    let id=btoa(obj.id);
    let html=`<form method="post" action="./categories.php?name=${obj.cat_name}">
    <div class="mb-3">
        <input type="hidden" name="post_id" value=${id}>
      <label for="title" class="form-label">Update title</label>
      <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title" value=${obj.title}>
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Update description</label>
      <textarea class="form-control" id="description" name="desc" rows=5>${obj.desc}</textarea>
    </div>
    <input type="submit" name="updatepost" id="updatepostbtn" hidden>
  </form>`;
    editpostmodal.innerHTML=html;
    let str=obj.cat_name;
    str=str.charAt(0).toUpperCase() + str.slice(1);
    editmodaltitle.innerText=`${str} Category`;
    let btn=document.getElementById("updatepostbtn");
    let updatepost=document.getElementById('updatepost');

    updatepost.addEventListener('click',()=>{
        btn.click();
    });
}
let carousel=document.querySelector(".carousel-control-next-icon");
if(carousel)
{
    setInterval(()=>{
        carousel.parentElement.click();
    },5000);
}