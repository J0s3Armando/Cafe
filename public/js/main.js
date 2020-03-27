window.onload= function()
{
  this.local2.click();
}


var local1 = document.getElementById('local1');
var local2 = document.getElementById('local2');
var local21 = document.getElementById('local21');

var loc1 ='<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3820.7381184075275!2d-92.63694663559711!3d16.73991367556193!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85ed45404ba3c519%3A0x44916911488108b0!2sMarchante%20Mercadito%20Culinario!5e0!3m2!1ses-419!2smx!4v1585281728811!5m2!1ses-419!2smx" frameborder="0" style="border:0;height:15rem;" class="w-100" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>';
var loc2 = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3820.454487258602!2d-93.14794720353726!3d16.754049173618675!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x5635acc6a97d13e8!2sHilton%20Garden%20Inn%20Tuxtla%20Gutierrez!5e0!3m2!1ses-419!2smx!4v1585154454325!5m2!1ses-419!2smx" frameborder="0" style="border:0;height:15rem;" allowfullscreen="" class="w-100" aria-hidden="false" tabindex="0"></iframe>';
var loc21 = '';
var map = document.getElementById('map');
function slideRight()
{
    var scrollbar = document.getElementById('items');
      scrollbar.scrollLeft +=60;
}

function slideLeft()
{
  var scrollbar = document.getElementById('items');
  scrollbar.scrollLeft -=60;
}

local1.addEventListener('click',function(){
  var hour = '<p class="h4">Horario</p><span class="btn mx-1 btn-sm mb-2 hour">Lunes a martes - 11:00 am a 9:00 pm</span>'+'<span class="btn mx-1 hour btn-sm mb-2 ">Miércoles a sábado - 11:00 am a 10:00 pm</span>' + '<span class="btn mx-1 hour btn-sm mb-2 ">Domingo - 9:00 am a 11:00 pm</span>'
  ;
  var container = createContainerMap(loc1,hour);
    map.appendChild(container); 
    local2.classList.remove('active');
    local21.classList.remove('active');
    local1.classList.add('active');
});

local2.addEventListener('click',function(){
  var hour = '<p class="h4">Horario</p><span class="btn mx-1 hour btn-sm mb-2 ">Abierto las 24 horas del día.</span>';
  var container = createContainerMap(loc2,hour);
  map.appendChild(container); 
  local21.classList.remove('active');
  local2.classList.add('active');
  local1.classList.remove('active');
});

local21.addEventListener('click',function()
{
  local21.classList.add('active');
  local2.classList.remove('active');
  local1.classList.remove('active');
});

function createContainerMap(url, hour)
{
  var container = document.createElement("div");
  container.classList.add('w-100');
  map.innerHTML='';
  container.innerHTML = hour +  url;
  return container;
}

