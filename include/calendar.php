<script>
    $(document).ready(function () {
        var endTime, startTime;
        var addEvent = $('#addEvent');
        var eventClicked =  $('#eventClicked');
        var calendar = $('#calendar').fullCalendar({
            themeSystem: 'bootstrap4',
            header: {
                left: '',
                center: 'title',
                right: 'prev next'

            },
            buttonText: {
                today: 'Today',
            },
            bootstrapFontAwesome: {
                next: 'angle-right',
                prev: 'angle-left',
            },
            droppable: true,
            events: '../include/loadevent.php?view=1',

            dayClick: function (date, jsEvent, view) {
                startTime = $.fullCalendar.moment(date).format('YYYY-MM-DD');
                endTime = $.fullCalendar.moment(date).add(1, 'd').format('YYYY-MM-DD');
                addEvent.find('#eventStart').val(startTime);
                addEvent.find('#eventEnd').val(endTime);
                addEvent.modal('toggle');
            },
            eventClick: function (event, jsEvent, view) {
                var id = event.id;
                $.ajax({
                    url: '../include/loadevent.php',
                    data: 'action=select&id=' + id,
                    type: "POST",
                    success: function (json) {
                        eventClicked.find('#eventId').val(json.id);
                        eventClicked.find('#eventTitle').val(json.title);
                        eventClicked.find('#eventVenue').val(json.venue);
                        eventClicked.find('#eventStart').val(json.start);
                        eventClicked.find('#eventDesc').val(json.description);
                        eventClicked.find('#subunit').val(json.subunit);
                        eventClicked.modal('toggle');
                    },
                    dataType:'json'
                });
            }
        });

        addEvent.find('#submitButton').on('click', function (e) {
            e.preventDefault();
            doSubmit();
        });
        eventClicked.find('#updateButton').on('click',function (e) {
            e.preventDefault();
            doUpdate();
        });
        function doUpdate() {
            eventClicked.modal('toggle');
            var id = eventClicked.find('#eventId').val();
            var title = eventClicked.find('#eventTitle').val();
            var venue = eventClicked.find('#eventVenue').val();
            var startTime = moment(eventClicked.find('#eventStart').val()).format('YYYY-MM-DD');
            var endTime = moment(eventClicked.find('#eventStart').val()).add(1, 'd').format('YYYY-MM-DD');
            var desc = eventClicked.find('#eventDesc').val();
            $.ajax({
                url: '../include/loadevent.php',
                data: 'action=update&id='+ id +'&title=' + title + '&venue=' + venue + '&description=' + desc + '&start=' + startTime + '&end=' + endTime,
                type: "POST",
                success: function (json) {
                    eventClicked.find('#eventDesc').val(json.description);
                    eventClicked.find('#eventVenue').val(json.venue);
                    $("#calendar").fullCalendar('removeEvents',json.id);
                    $("#calendar").fullCalendar('renderEvent',
                        {
                            id: json.id,
                            title: json.title,
                            start: json.start,
                            end: json.end
                        },
                        true);

                },
                dataType:'json'
            });
        }
        function doSubmit() {
            addEvent.modal('toggle');
            var title = addEvent.find('#eventTitle').val();
            var venue = addEvent.find('#eventVenue').val();
            var startTime = addEvent.find('#eventStart').val();
            var endTime = addEvent.find('#eventEnd').val();
            var desc = addEvent.find('#eventDesc').val();
            var subunit = addEvent.find('#subunit').val();
            $.ajax({
                url: '../include/loadevent.php',
                data: 'action=add&title=' + title + '&venue=' + venue + '&description=' + desc + '&start=' + startTime + '&end=' + endTime + '&subunit=' + subunit,
                type: "POST",
                success: function (json) {
                    $("#calendar").fullCalendar('renderEvent',
                        {
                            id: json.id,
                            title: title,
                            start: startTime,
                            end: endTime
                        },
                        true);
                }
            });

        }
    });

</script>

<div id="calendar"></div>
<!--modal add event -->
<div class="modal fade" id="addEvent" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Add Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="eventTitle"><b>Event</b></label>
                        <input required type="text" id="eventTitle" class="form-control" placeholder="Event Title">
                    </div>
                    <div class="form-group">
                        <label for="eventVenue"><b>Venue</b></label>
                        <input required type="text" id="eventVenue" class="form-control" placeholder="Venue">
                    </div>
                    <div class="form-group">
                        <label for="eventDesc"><b>Description</b></label>
                        <textarea id="eventDesc" class="form-control" rows="5"
                                  placeholder="Event Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="eventStart"><b>Date</b></label>
                        <input required type="text" id="eventStart" readonly class="form-control">
                    </div>
                    <input type="hidden" value="<?php echo $_SESSION["subunit"]?>" id="subunit">
                    <input type="hidden" id="eventEnd">
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" id="submitButton" class="btn btn-primary">Done</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--modal event clicked-->
<div class="modal fade" id="eventClicked" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Event Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="eventId">
                    <div class="form-group">
                        <label for="eventTitle"><b>Event</b></label>
                        <input type="text" id="eventTitle" class="form-control" placeholder="Event Title">
                    </div>
                    <div class="form-group">
                        <label for="eventVenue"><b>Venue</b></label>
                        <input type="text" id="eventVenue" class="form-control" placeholder="Venue">
                    </div>
                    <div class="form-group">
                        <label for="eventDesc"><b>Description</b></label>
                        <textarea id="eventDesc" class="form-control" rows="5"
                                  placeholder="Event Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="eventStart"><b>Date</b></label>
                        <input type="text" id="eventStart" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="subunit"><b>Sub-unit</b></label>
                        <input type="text" id="subunit" class="form-control" disabled>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" id="updateButton" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script src="../js/bootstrap.js" type="text/javascript"></script>
