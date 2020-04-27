document.getElementById('image').onchange=function(e){
    var files = e.target.files;
    var type = files[0].type;
    var preview = document.getElementById('preview');
    var lblNameFile = document.getElementById('lblNameFile');
    lblNameFile.innerHTML=files[0].name;
    preview.innerHTML='';
if(type.match("image/*"))
{    
    var reader = new FileReader();
    reader.readAsDataURL(e.target.files[0]);
    reader.onload=function()
    {
        var image = document.createElement('img');
        image.classList="img-fluid w-100";
        image.src=reader.result;
        preview.appendChild(image);
    };              
}
else{
    var messageAlert = document.createElement('div');
    messageAlert.classList = "alert alert-danger";
    var message = "El archivo seleccionado no cuenta con el formato requerido";
    messageAlert.innerHTML=message;
    preview.appendChild(messageAlert);
}
}

document.getElementById('idForm').onchange=function(e)
{
document.getElementById('btnForm').disabled=false;
};
