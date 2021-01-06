const CustomViewConfig = {

    classNames: ['custom-view'],
    contentHeight: 'auto',
    height: 'auto',
    buttonText: 'day',
    type: 'timeGrid',
    duration: { days: 1 },

    eventContent: function(arg) {

        let content = document.createElement('div')
        content.innerHTML = '<img src="' + arg.event._def.extendedProps.seal + '"/>'
        let arrayOfDomNodes = [content]
        return { domNodes: arrayOfDomNodes }
    },
    content: function(props) {
        console.log(props);
        let segs = FullCalendar.sliceEvents(props, true);
        day_event = segs[0];
        let aufwaermuebung = '';

        day_event.def.extendedProps.aufwaermuebung.forEach(function(entry) {
            aufwaermuebung += '<div>' + entry.title + '</div>';
            aufwaermuebung += '<div>' + entry.content + '</div>';
        });
        let atemuebung = '';

        day_event.def.extendedProps.atemuebung.forEach(function(entry) {
                atemuebung += '<div>' + entry.title + '</div>';
                atemuebung += '<div>' + entry.content + '</div>';
            }

        );
        let html =
            '<div class="view-title"><img style="width:200px;" id="' + day_event.def.extendedProps.seal_id + '" src=" ' + day_event.def.extendedProps.seal + '"/><label for="repeat">Wähle Wiederholung:</label>' +
            '<select id="repeat" name="repeat"><option value="4">4</option> <option value="7">7</option><option value="13">13</option><option value="20">20</option><option value="20">20</option><option value="33">33</option><option value="40">40</option><option value="44">44</option><option value="51">51</option></select>' +
            '<span id="moon_cycle">Vollmond</span>' +
            '</div>'

        +`<div id="accordion">
<div class="card">
  <div class="card-header" id="headingOne">
    <h5 class="mb-0">
      <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" >
      ` + day_event.def.extendedProps.workout_title + `
      </button>
    </h5>
  </div>

  <div id="collapseOne" class="collapse accordion" aria-labelledby="headingOne" data-parent="#accordion">
    <div class="card-body">
    ` + day_event.def.extendedProps.workout_content + `
    </div>
  </div>
</div>

</div>
` +
            `<div id="accordion">
<div class="card">
  <div class="card-header" id="headingOne">
    <h5 class="mb-0">
      <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
Workouts
      </button>
    </h5>
  </div>

  <div id="collapseTwo" class="collapse accordion" aria-labelledby="headingOne" data-parent="#accordion" style="height:0px">
    <div class="card-body">
    ` + day_event.def.extendedProps.workout_title + `
    ` + atemuebung + `
    </div>
  </div>
</div>` +
            `<div id="accordion">
<div class="card">
  <div class="card-header" id="headingOne">
    <h5 class="mb-0">
      <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne">
Atemübungen
      </button>
    </h5>
  </div>

  <div id="collapseThree" class="collapse accordion " aria-labelledby="headingOne" data-parent="#accordion" style="height:0px">
    <div class="card-body">
    ` + day_event.def.extendedProps.workout_title + `
    ` + aufwaermuebung + `
    </div>
  </div>
</div>
</div>
`
        return { html: html }
    }

}
const CustomViewYear = {

    classNames: ['year'],


    contentHeight: 'auto',
    height: 'auto',
    buttonText: 'year',
    type: 'listYear',


    dateIncrement: {
        years: 1
    },
    slotDuration: {
        months: 12
    },
    slotMinTime: {
        months: 12
    },
    slotMaxTime: {
        months: 12
    },
    visibleRange: function(currentDate) {
        return {
            start: currentDate.clone().startOf('year'),
            end: currentDate.clone().endOf("year")
        };
    },



    content: function(props) {
        var months = ["Januar", "Februar", "März", "April", "Mai", "June", "July", "August", "September", "October", "November", "December"];
        var d = new Date();
        var monthName = months[d.getMonth()]; // "July" (or current month)
        custom_month_view = ''
        console.log(props)
        n = 0;

        while (n < 12) {
            sep = '';
            sep_end = '';

            if (n % 3 == 0) {
                //   alert(n);
                sep = '<tr>';
                sep_end = '</tr>';
            } else {
                sep = '';
                sep_end = '';
            }

            custom_month_view += '<div data-month="' + n + '" class="fc-month-view"><div class="month" id="' + n + '">' + months[n] + '</div>'
            n++;

        }
        // let html = '<div class="month">1</div><div class="month">1</div><div class="month">1</div><div class="month">1</div><div class="month">1</div><div class="month">1</div><div class="month">1</div><div class="month">1</div><div class="month">1</div><div class="month">1</div><div class="month">1</div>'
        let html = '<div class="year-grid">' + custom_month_view + '</div>'
            // let html = '';
        return { html: html }
    }
}



var FC = jQuery.fullCalendar; // a reference to FullCalendar's root namespace
var View = FC.View; // the class that all views must inherit from
var CustomView; // our subclass

CustomView = View.extend({ // make a subclass of View
    type: 'agenda',
    duration: { days: 1 },
    dayCount: 1,
    visibleRange: {
        start: '2017-03-22',

    },
    initialize: function() {
        // type: 'basic',
        // duration: { days: 1 }
    },

    render: function() {
        //  type: 'basic',
        //  duration: { days: 1 }
        // responsible for displaying the skeleton of the view within the already-defined
        // this.el, a jQuery element.
        //   console.log(this.el)
    },

    setHeight: function(height, isAuto) {
        // responsible for adjusting the pixel-height of the view. if isAuto is true, the
        // view may be its natural height, and `height` becomes merely a suggestion.
    },

    renderEvents: function(events) {
        // reponsible for rendering the given Event Objects
        //  console.log(events);
    },

    destroyEvents: function() {
        // responsible for undoing everything in renderEvents
    },

    renderSelection: function(range) {
        console.log(range);
        // accepts a {start,end} object made of Moments, and must render the selection
    },

    destroySelection: function() {
        // responsible for undoing everything in renderSelection
    }

});

FC.views.custom = CustomView; // register our class with the view system


function single_day_template(event, element, view) {
    console.log(event)


    let aufwaermuebung = '';
	try {
    if (event.aufwaermuebung) { 

        event.aufwaermuebung.forEach(function (entry) {
    
            if (entry.content) { 
                aufwaermuebung += '<div>' + entry.content + '</div>';
            }
        aufwaermuebung += '<div>' + entry.title + '</div>';
  
  
    });
}}
catch(err) {
console.log(err)
}
    
 
    let atemuebung = '';
	try {
		    if (event.aufwaermuebung) { 
		console.log(typeof event.atemuebung)
		console.log(event.atemuebung)

    event.atemuebung.forEach(function(entry) {
        atemuebung += '<div>' + entry.title + '</div>';
        atemuebung += '<div>' + entry.content + '</div>';
    });
    }
}
catch(err) {
console.log(err)
}

var moon_phase = '<span></span>'
    if (event.moon_phase) {

        var moon_phase = '<span>' + event.moon_phase + '</span>'
    } 
    
    let html = '<div class="view-title"><img style="width:200px;" id="" src="' + event.seal + '"/>'+event.color_title+' ' +
        '' + moon_phase +
        '</div>'
        
        /* +
    `<div id="accordion">
<div class="card">
<div class="card-header" id="headingOne">
<h5 class="mb-0">
<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" >` +
    event.workout_title + `
</button>
</h5>
</div>

<div id="collapseOne" class="collapse accordion" aria-labelledby="headingOne" data-parent="#accordion">
<div class="card-body">
` + event.workout_content +
        `
</div>
</div>
</div>

</div>
` +
        `<div id="accordion">
<div class="card">
<div class="card-header" id="headingOne">
<h5 class="mb-0">
<button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
Workouts
</button>
</h5>
</div>
<div id="collapseTwo" class="collapse accordion" aria-labelledby="headingOne" data-parent="#accordion" style="height:0px">
<div class="card-body">
` + aufwaermuebung + `
</div>
</div>
</div>` +
        `<div id="accordion">
<div class="card">
<div class="card-header" id="headingOne">
<h5 class="mb-0">
<button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne">
Atemübungen
</button>
</h5>
</div>

<div id="collapseThree" class="collapse accordion " aria-labelledby="headingOne" data-parent="#accordion" style="height:0px">
<div class="card-body">

` + atemuebung +
        `
</div>
</div>
</div>
</div>

`
*/
    return html

}