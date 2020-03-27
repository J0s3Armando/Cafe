
var local1 = document.getElementById('local1');
var local2 = document.getElementById('local2');
var local21 = document.getElementById('local21');

var loc1 ='';
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
    //var url = createContainerMap('');
    //map.appendChild(container); 
    local2.classList.remove('active');
    local21.classList.remove('active');
    local1.classList.add('active');
});

local2.addEventListener('click',function(){
  var container = createContainerMap(loc2);
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

function createContainerMap(url)
{
  var container = document.createElement("div");
  container.classList.add('w-100');
  map.innerHTML='';
  container.innerHTML =url;
  return container;
}