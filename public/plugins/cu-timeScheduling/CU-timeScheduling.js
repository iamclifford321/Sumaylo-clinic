(function($) {
  $.fn.CUScheduling = function(options) {
        // generate standard hieght for the parent element
        this.css({
          'height' : '400px',
          'overflow-y' : 'scroll',
          'padding' : '10px 0'
        })
        // Variables needed
        var allHours = ['', '12 am', '1 am', '2 am', '3 am', '4 am', '5 am', '6 am', '7 am', '8 am', '9 am', '10 am', '11 am', '12 pm', '1 pm', '2 pm', '3 pm', '4 pm', '5 pm', '6 pm', '7 pm', '8 pm', '9 pm', '10 pm', '11 pm'];
        var allHoursZero = [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23 ];
        var hourElem = $('<div class="HourElemWithMinute"/>').css({
          'width' : '80%',
          'position' : 'relative'
        });
        var hoursElement = $('<div class="HourElementWithoutMinute"/>').css({
          'width' : '20%',
        });
        var hourCount = 1;
        // extend the options from pre-defined values:
        var param = $.extend({
          schedules : [],
          timeRange : '',
          getTheTime  : function() {}
        },options);
        console.log(param.timeRange);

        let hourForMinuteRange = 0;
        let heightRangeForTargeter = param.timeRange.split(':');
        if (parseInt(heightRangeForTargeter[0]) > 0) {
          hourForMinuteRange = parseInt(heightRangeForTargeter[0]) * 60;
        }
        let rangeTimeTargeter = hourForMinuteRange + parseInt(heightRangeForTargeter[1]);

        // Generate needed element
        this.append($('<div id="day"/>'));
        var elementTargetLocker = $('<div/>').attr('id','targetLocker').css(
                                  {
                                    'position':'absolute',
                                    'background' : '#c6c8ca',
                                    'height' : rangeTimeTargeter + 'px',
                                    'width' : '100%',
                                    'border-radius' : '5px',
                                    'border' : '1px solid black',
                                    'z-index' : 0
                                  }
                                )
        // place the targetLocker element to right hour.
        $(document).on('mousemove', '.HourElemWithMinute', function(e){
          var x = e.pageX - $(this).offset().left;
          var y = e.pageY - $(this).offset().top;

          $(this).prepend(elementTargetLocker);
          elementTargetLocker.css( {'top' : y + 'px'} );
        })
        // Create the grid which represents the hours and minutes.
        for (var i = 1; i <= 24; i++) {
          var houDiv = $('<div class="' +  allHoursZero[i - 1]  + '" hour-indicator="' + allHoursZero[i - 1] + '"/>').css({
            'z-index' : '1',
            'position' : 'relative'
          });
          var hoours = $('<div class="' + i + ' theHour-' + i + '"/>').css({
            'width' : '100%',
            'height' : '60px',
            'border' : '1px solid grey',
            'text-align' : 'center',
          }).text(allHours[i]);

          for (var j = 30; j <= 60; j+=30) {
            let heightMinute = '0';
            if (j == 60) {
              heightMinute = '30';
            }
            houDiv.append($('<div class="'+ j +' CMU-half-hour" in-Minute=' + heightMinute + ' />').css({
              'height' : '30px',
              'width'  : '100%',
              'border'  : '1px',
              'border-color' : 'rgba(0,0,0,.5)',
              'border-style' : 'dotted',
              'border-left-style' : 'solid',
              'border-right-style' : 'solid'
            }));
          }
          hoursElement.append(hoours);
          hourElem.append(houDiv);
          hourCount ++;
        }
        // Append the generate minutes and hours to the day element
        $('#day').append(hoursElement, hourElem).css({
          'display' : 'flex'
        });
        //  Fill the Schecduled times
        for (var i = 0; i < param.schedules.length; i++) {

          let hourTime = parseInt(param.schedules[i].time.split(':')[0]);
          let topPosition = hourTime * 60 + parseInt(param.schedules[i].time.split(':')[1]);
          let hourForMinute = 0;
          let heightRange = param.schedules[i].range.split(':');
          if (parseInt(heightRange[0]) > 0) {
            hourForMinute = parseInt(heightRange[0]) * 60;
          }
          let rangeTime = hourForMinute + parseInt(heightRange[1]);
          var backgroundTobe = '';
          var borderBackground = '';
          var elmnttoBeAppended;
          if (param.schedules[i].isDefault) {
            backgroundTobe = 'rgba(0,0,0,0.5)';
            borderBackground = 'rgba(0,0,0,1)';
            elmnttoBeAppended = $('<span/>').text(param.schedules[i].content).css({
              'color' : 'white',
              'text-align' : 'center',
              'display' : 'block',
              'margin-top' : '5px'
            })
          }else{
            backgroundTobe = 'rgba(54,62,152,0.7)';
            borderBackground = 'rgba(54,62,152,1)';
            elmnttoBeAppended = $('<a/>').text(param.schedules[i].content).css({
              'color' : 'white',
              'text-align' : 'center',
              'display' : 'block',
              'margin-top' : '5px'
            })
          }

          $('.HourElemWithMinute').append(
            $('<div class="fillSched"/>').css({
              'position' : 'absolute',
              'top' : topPosition + 'px',
              'width' : '100%',
              'height' : rangeTime + 'px',
              'background' : backgroundTobe,
              'border-radius' : '5px',
              'border' : '1px solid black',
              'border-left' : '5px solid ' + borderBackground,
              'z-index': '2',
            }).append(elmnttoBeAppended)
          );
        }
        // Trigger event for checking and getting availble date.
        $(document).on('click', '.CMU-half-hour', function(e){
          var targetLockerTop = $('#targetLocker').position().top;
          var targetLockerBottom = $('#targetLocker').position().top + $('#targetLocker').outerHeight();
          var y = e.pageY - $(this).offset().top;
          var minuteTo = y + parseInt($(this).attr('in-minute'));

          let hoursFinal = '';
          let minuteFinal = '';
          if ($(this).parent().attr('hour-indicator').length == 1) {
            if (minuteTo.toString().length == 1) {
              minuteFinal = '0' + minuteTo.toString();
            }else{
              minuteFinal = minuteTo.toString();
            }
            hoursFinal = '0' + $(this).parent().attr('hour-indicator') + ':' + minuteFinal + ':00';
          }else{
            if (minuteTo.toString().length == 1) {
              minuteFinal = '0' + minuteTo.toString();
            }else{
              minuteFinal = minuteTo.toString();
            }
            hoursFinal = $(this).parent().attr('hour-indicator') + ':' + minuteFinal + ':00';
          }
          var scheduleOk = [];
          var isNotOk = true;
          $('.fillSched').each(function(){
            let topOfSched = parseInt($(this).position().top);
            let rangeOfSched = parseInt($(this).position().top) + $( this ).outerHeight();

            if ((targetLockerBottom < topOfSched && targetLockerBottom < rangeOfSched) || (targetLockerTop > topOfSched)) {
              // scheduleOk['asd'] = 'asd';
            }else{
              isNotOk = false;
            }
          });
          if (isNotOk) {
            // console.log(hoursFinal);
            if ($('#targetedTime').length < 1) {

              $('.HourElemWithMinute').append(
                $('<div/>').css({
                  'position' : 'absolute',
                  'top' : targetLockerTop + 'px',
                  'height' : rangeTimeTargeter + 'px',
                  'width' : '100%',
                  'background' : 'rgba(64, 151, 220, 0.68)',
                  'color' : 'white',
                  'text-align' : 'center'
                }).text($('[name=serviceName]').val()).attr('id', 'targetedTime')
              );

            }else{

              $('#targetedTime').remove();
              $('.HourElemWithMinute').append(
                $('<div/>').css({
                  'position' : 'absolute',
                  'top' : targetLockerTop + 'px',
                  'height' : rangeTimeTargeter + 'px',
                  'width' : '100%',
                  'background' : 'rgba(64, 151, 220, 0.68)',
                  'color' : 'white',
                  'text-align' : 'center'
                }).text($('[name=serviceName]').val()).attr('id', 'targetedTime'));
            }


            param.getTheTime.call(this, hoursFinal);
            return false;

          }

        })
        return this;
    };
  }(jQuery));
