<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> Letsnamaste | My Meeting </title>
  <link href='fullcalendar/packages/core/main.css' rel='stylesheet' />
  <script src="js/library.js"></script>
  <link href='fullcalendar/packages/bootstrap/main.css' rel='stylesheet' />
  <link href='fullcalendar/packages/timegrid/main.css' rel='stylesheet' />
  <link href='fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
  <link href='fullcalendar/packages/list/main.css' rel='stylesheet' />
  <link href='css/mymeetings.css' rel='stylesheet' />
  <script src='js/config.js'></script>
  <script src='js/mymeetings.js'></script>
  <script src='fullcalendar/packages/core/main.js'></script>
  <script src='fullcalendar/packages/interaction/main.js'></script>
  <script src='fullcalendar/packages/bootstrap/main.js'></script>
  <script src='fullcalendar/packages/daygrid/main.js'></script>
  <script src='fullcalendar/packages/timegrid/main.js'></script>
  <script src='fullcalendar/packages/list/main.js'></script>
  <script src='fullcalendar/examples/js/theme-chooser.js'></script>

 <script>
      $(window).on( "load", function() {
        if(userInfo.hasOwnProperty('confirmation_time') == false){
          $('.js-toolbar-region div').show();
        }else{
          $('.js-toolbar-region div').hide();
        }
        getMeetings();
        $('.upcoming-events').on('click',function(e){
          getUpcomingEvents();
            $('.upcoming-events').addClass('_2S9ml___Tab__selected');
            $('.past-events').removeClass('_2S9ml___Tab__selected');
        });
        $('.past-events').on('click',function(e){
            $('.past-events').addClass('_2S9ml___Tab__selected');
            $('.upcoming-events').removeClass('_2S9ml___Tab__selected');
            getPastEvents();
        });
      });
/*document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
    defaultView: 'dayGridMonth',
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    events: event,
    default: '00:30:00'
  });

  calendar.render();
});*/
var event = [{title: '15 minute Meeting',start: '2020-06-17T16:30:00'},{title: '15 minute Meeting',start: '2020-06-17T16:45:00'}];

  </script>



</head>
<body>
<div id="page-region">
  <div id="popup-region"></div>
  <div id="alert-region"></div>
  <div id="root"></div>
      <header class="L2Qtd___index-Container__cls1">
        <div class="_3bq4o___index-InnerContainer__cls1">
          <div data-component="full-header" class="_1g8Lp___index-Logo__cls1">
            <a aria-label="Home" class="_27lBG___index-Link__cls1 _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" href="/home">
              <!-- <img src="/packs/media/images/logo-square-8da30b0ff31397b3e2df781ff0bde4d3.png" alt="" width="35" height="35"> -->
            </a>
          </div>
          <ul class="ChwVX___navigation-List__cls1 _1Amac___navigation-List__isTabletUp">
            <li>
              <!-- <a class="v8LMF___navigation_link-Link__cls1 _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" href="myevents">Home</a> -->
            </li>
          </ul>
          <div class="user_menu_Container user_menu_Container_isTabletU">
            <a aria-label="Account" class="user_menu_UserMenuControl _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" type="button" href='profile'>
              <!-- <div class="_30KQ4___user_menu-Avatar__cls1">P</div> -->
              <div class="_1n_Sb___user_menu-Label__cls1">Account</div>
            </a>
          </div>
        </div>
      </header>
  <div class="body-content getting-started-present">
    <div data-component="home-bar">
      <div class="scope-dropdown-wrapper mbl">

        <div class="wrapper mtx">
          <nav class="Tabs__cls1___giA3k">
            <div class="tabs-InnerContainer__cls1___KZqW_">
              <a class="Tab__cls1___3N12Y BareButton__cls1___1Qg-r index-UnstyledButton__cls1___2zIir" type="button" href="myevents">
                <div class="tab-Text__cls1___16FTS"> Event Type </div>
              </a>
              <a class="_3N12Y___Tab__cls1 _2S9ml___Tab__selected _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1 _1-i0z___index-UnstyledButton__disabledState" type="button" disabled>
                <div class="_16FTS___tab-Text__cls1"> Scheduled Events </div>
              </a>
            </div>
          </nav>
        </div>
      </div>
    </div>
    <div data-component="home-content">
      <div class="index-Container__cls1___2shWd">
        <div class="index-Box__cls1___22Ppv">
          <div class="filter-list">
            <div class="filter-list-bar">
              <div class="filter-list-tabs">
                <nav data-component="primary-bar-tabs" class="giA3k___Tabs__cls1">
                  <div class="KZqW____tabs-InnerContainer__cls1">
                    <button class="_3N12Y___Tab__cls1 _2S9ml___Tab__selected _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1 upcoming-events" type="button">
                      <div class="_16FTS___tab-Text__cls1">Upcoming</div>
                    </button>
                    <button class="past-events _3N12Y___Tab__cls1 _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1 past-evets" type="button">
                      <div class="_16FTS___tab-Text__cls1">Past</div>
                    </button>
                  </div>
                </nav>
              </div>
            </div>
          </div>
          <div class="meetings-container">
            <div data-component="empty-state" class="_1cnet___empty_state-Container__cls1">
              <img src="https://calendly.com/packs/media/images/scheduled_events/empty_state/no-events-2ed89b6c6379caebda4e779dd1db762c.svg" width="120" height="120" alt=""/>
              <div class="hNSDX___empty_state-Title__cls1">No Upcoming Events</div>
            </div>
          </div>
        </div>
      </div>
          <div class="js-dropdown-trigger-region"></div>
          <div class="js-toolbar-region">
            <div style="display: none;">
              <div class="bulk-toolbar">
                <div class="wrapper">
                  <div class="verify-message">
                    <div>
                      <h3 class="email-verify"> This email is not verified. <a href="verification"> Please click here to verify your Email ID </a></h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
  </div>
</div>
</body>
</html>