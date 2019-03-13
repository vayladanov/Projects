<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
/*
Small function used to show some information about how much time has passed since an event occured. Jquery can be replaced by native js with a few edits
Version 0.1.0 13/03/2019
*/
function timeSince(el, timeofEvent) { //both parameters should be strings. el = jQuery selector of the element where output should go. timeofEvent = date of the event(month day year hour:minutes:seconds)
    var element = $(el);
    var currentDate = new Date(); //this is the current date to which we compare the stuff
    var event = new Date(timeofEvent); //the stuff or otherwise known as the time the comment was posted on this is the second parameter of our calculations. Presumably here you would load the time of the event in question
    var eventDate = ('0'+event.getDate()).slice(-2);
    var eventMonth = event.getMonth();
    var eventYear = event.getFullYear();
    var eventHour = ('0'+event.getHours()).slice(-2);
    var eventMinute = ('0'+event.getMinutes()).slice(-2);
    var eventSecond = ('0'+event.getSeconds()).slice(-2);
    var eventWeekDay = event.getDay();

    const weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    if ((currentDate.getTime()-event.getTime())/1000 < 60) { //minute
        if ((currentDate.getTime()-event.getTime())/1000 > 0) { // checking if the event is in the past or in the future
            element.html((Math.round((currentDate.getTime()-event.getTime())/1000)) + ' seconds ago');
        } else {
            element.html("Event date is in the future!"); //No future functionality implemented yet
        }
    } else if ((currentDate.getTime()-event.getTime())/1000 < 3600) { //hour
        element.html((Math.round((currentDate.getTime()-event.getTime())/1000/60)) + ' minutes ago');
    } else if ((currentDate.getTime()-event.getTime())/1000 < 172800) { //day
        if (currentDate.toDateString() == event.toDateString()) {
            element.html((Math.round((currentDate.getTime()-event.getTime())/1000/60/60)) + ' hours ago'); //hours
        } else {
            element.html("Yesterday at " + eventHour + ":" + eventMinute); //yesterday
        }
    } else if ((currentDate.getTime()-event.getTime())/1000 >= 172800 && (currentDate.getTime()-event.getTime())/1000 < 604800) { //day of the week
        element.html(weekday[eventWeekDay] + " at " + eventHour + ":" + eventMinute);
    } else if ((currentDate.getTime()-event.getTime())/1000 >= 604800) { //date
        element.html(eventDate + " " + monthNames[eventMonth] + " " + eventYear + " " + eventHour + ":" + eventMinute);
    }
}
</script>
<div class="commentTime"></div>
<script>
    timeSince('.commentTime', '03 13 2019 08:00:00');
</script>
