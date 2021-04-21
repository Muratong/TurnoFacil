function LTCalendar(date) {
  
  if (!(date instanceof Date)) {
    date = new Date();
  }
  
  this.days = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
  this.months = months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Deciembre'];

  this.eles = {
  };

  this.calDaySelected = null;
  
  this.calendar = document.getElementById("calendar");
  
  this.calendarDays = document.getElementById("cdays");
  
  this.calendarCurrent = document.getElementById("cmcurrent");
  this.calendarMonthLast = document.getElementById("cmlast");
  this.calendarMonthNext = document.getElementById("cmnext");
  
  this.dayInspirationalQuote = document.getElementById("inspirational-quote");

  // this.eventsCountSpan = document.getElementById("footer-events");
  this.calendarModal = document.getElementById("cmodal");
  this.calendarModalExit = document.getElementById("cmexit");
  this.calendarModalDate = document.getElementById("cmdate");
  
  /* Start the app */
  this.showView(date);
  this.addEventListeners();
}

LTCalendar.prototype.addEventListeners = function(){
  
  this.calendar.addEventListener("click", this.mainCalendarClickClose.bind(this));
  this.calendarMonthLast.addEventListener("click", this.showNewMonth.bind(this));
  this.calendarMonthNext.addEventListener("click", this.showNewMonth.bind(this));
  this.calendarModalExit.addEventListener("click", this.closeDayWindow.bind(this));
  this.calendarModalDate.addEventListener("click", this.showNewMonth.bind(this));
  
};

LTCalendar.prototype.showView = function(date){
  if ( !date || (!(date instanceof Date)) ) date = new Date();
  var now = new Date(date),
      y = now.getFullYear(),
      m = now.getMonth();
  var today = new Date();
  
  var lastDayOfM = new Date(y, m + 1, 0).getDate();
  var startingD = new Date(y, m, 1).getDay();
  var lastM = new Date(y, now.getMonth()-1, 1);
  var nextM = new Date(y, now.getMonth()+1, 1);
 
  this.calendarCurrent.classList.remove("cmactive");
  this.calendarCurrent.classList.add("cmreset");
  
  while(this.calendarDays.firstChild) {
    this.calendarDays.removeChild(this.calendarDays.firstChild);
  }

  for ( var x = 0; x < startingD; x++ ) {
    var spacer = document.createElement("div");
    spacer.className = "cvr";
    this.calendarDays.appendChild(spacer);
  }
  
  for ( var z = 1; z <= lastDayOfM; z++ ) {
   
    var _date = new Date(y, m ,z);
    var day = document.createElement("div");
    day.className = "cdays";
    day.textContent = z;
    day.setAttribute("data-date", _date);
    day.onclick = this.showDay.bind(this);
    
    // check if todays date
    if ( z == today.getDate() && y == today.getFullYear() && m == today.getMonth() ) {
      day.classList.add("today");
    }
    
    this.calendarDays.appendChild(day);
  }
  
  var _that = this;
  setTimeout(function(){
    _that.calendarCurrent.classList.add("cmactive");
  }, 50);
  
  this.calendarCurrent.textContent = this.months[now.getMonth()] + " " + now.getFullYear();
  this.calendarCurrent.setAttribute("data-date", now);

  
  this.calendarMonthLast.textContent = "<";
  this.calendarMonthLast.setAttribute("data-date", lastM);
  
  this.calendarMonthNext.textContent = ">";
  this.calendarMonthNext.setAttribute("data-date", nextM);
  
}

LTCalendar.prototype.showDay = function(e, dayEle) {
  e.stopPropagation();
  if ( !dayEle ) {
    dayEle = e.currentTarget;
  }
  var dayDate = new Date(dayEle.getAttribute('data-date'));
  
  this.calDaySelected = dayEle;
  
  this.openDayWindow(dayDate);
  
};

LTCalendar.prototype.closeDayWindow = function(){
  this.calendarModal.classList.remove("calendar-modal-active");
};

LTCalendar.prototype.mainCalendarClickClose = function(e){
  if ( e.currentTarget != e.target ) {
    return;
  }
  this.calendarModal.classList.remove("calendar-modal-active");
};

var timeOut = null;
var activeEle = null;

LTCalendar.prototype.showNewMonth = function(e){
  var date = e.currentTarget.dataset.date;
  var newMonthDate = new Date(date);
  this.showView(newMonthDate);
  this.closeDayWindow();
  return true;
};