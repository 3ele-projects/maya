const CustomViewConfig = {

  classNames: ['custom-view'],
  contentHeight: 'auto',
  height: 'auto',
  buttonText: 'day',
  type: 'timeGrid',
  duration: { days: 1 },
    
  eventContent: function (arg) {
    
    let content = document.createElement('div')
    content.innerHTML = '<img src="' + arg.event._def.extendedProps.seal + '"/>adadsa';
    let arrayOfDomNodes = [content]
    return { domNodes: arrayOfDomNodes }
  },
  content: function (props) {
    
    let segs = FullCalendar.sliceEvents(props, true);
    day_event = segs[0];
    let aufwaermuebung = '';

    day_event.def.extendedProps.aufwaermuebung.forEach(function (entry) {
      aufwaermuebung += '<div>' + entry.title + '</div>';
      aufwaermuebung += '<div>' + entry.content + '</div>';
    }); 
    let atemuebung = '';

    day_event.def.extendedProps.atemuebung.forEach(function (entry) {
      atemuebung += '<div>' + entry.title + '</div>';
      atemuebung += '<div>' + entry.content + '</div>';
    }  

      );
      let html =
        '<div class="view-title"><img style="width:200px;" src=" '+day_event.def.extendedProps.seal +'"/><label for="cars">Wähle Wiederholung:</label>'+
     '<select id="repeat" name="repeat"><option value="1">1</option> <option value="2">2</option><option value="3">3</option><option value="4">4</option></select>'+
        
        '</div>'

+`<div id="accordion">
<div class="card">
  <div class="card-header" id="headingOne">
    <h5 class="mb-0">
      <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" >
      ` +day_event.def.extendedProps.workout_title +`
      </button>
    </h5>
  </div>

  <div id="collapseOne" class="collapse accordion" aria-labelledby="headingOne" data-parent="#accordion">
    <div class="card-body">
    ` +day_event.def.extendedProps.workout_content +`
    </div>
  </div>
</div>

</div>
`
+`<div id="accordion">
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
    ` +day_event.def.extendedProps.workout_title +`
    ` +atemuebung+`
    </div>
  </div>
</div>`
+`<div id="accordion">
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
    ` +day_event.def.extendedProps.workout_title +`
    ` +aufwaermuebung+`
    </div>
  </div>
</div>
</div>
`    
      return { html: html }
    }
    
}
    


    