<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        @yield('message')
    </div>
<style>

        @import url("https://fonts.googleapis.com/css?family=Noto+Sans+JP:400,500&display=swap");
    
    * {
      box-sizing: border-box;
      padding: 0;
      margin: 0;
    }
    body {
    
    }
    /* display the wrapping container in the top right corner of the viewport */
    .notification {
      position: fixed;
      top: 0.5rem;
      right: 1rem;
      /* align the content to the rigth */
      display: flex;
      flex-direction: column;
      align-items: flex-end;
      color: hsl(0, 0%, 20%);
      /* hide the overflow to conceal the message when translated to the right of the container */
      overflow-x: hidden;
      /* padding to avoid cropping the box-shadow on the message */
      padding: 0.25rem;
    }
    
    /* reduce the size of the icon and give a white fill to the elements of the graphic */
    .notification__bell {
      display: block;
      width: 48px;
      height: auto;
      fill: hsl(0, 0%, 100%);
    }
    /* when the .notification container is given a class of .received animate the body and clapper of the bell to swing
    ! animate the clapper with a slight delay as to follow through the animation of the main body
    */
    .notification.received .bell__body {
      animation: swingBody 0.7s 0.02s cubic-bezier(0.455, 0.03, 0.515, 0.955);
    }
    .notification.received .bell__clapper {
      animation: swingClapper 0.7s 0.04s cubic-bezier(0.455, 0.03, 0.515, 0.955);
    }
    /* ! for both elements the rotation occurs using the parent group element as a hinge, allowing for the pendulum-like swing */
    @keyframes swingBody {
      25% {
        transform: rotate(-5deg);
      }
      75% {
        transform: rotate(5deg);
      }
    }
    /* animation for the clapper, following the main body and with a larger rotation */
    @keyframes swingClapper {
      5% {
        transform: rotate(0deg);
      }
      30% {
        transform: rotate(-8deg);
      }
      80% {
        transform: rotate(8deg);
      }
    }
    
    /* style the content of the message to show a grid with the dismiss button in the top right corner
    |h1  |  button |
    |p   |p        |
    */
    .notification__message {
      display: grid;
      grid-gap: 0.2rem;
      grid-template-columns: 1fr auto;
      padding: 0.5rem 1rem;
      margin: 1rem 0;
      /* style the div as a rounded rectangle with a border on the left segment */
      background: hsl(0, 0%, 100%);
      border-radius: 10px;
      box-shadow: 0 0 5px hsla(0, 0%, 0%, 0.1), 0 2px 3px hsla(0, 0%, 0%, 0.1);
      border-left: 0.5rem solid hsl(0, 0%, 100%);
      /* by default hide the element from sight and include a transition for the chosen properties */
      transform: translateX(100%);
      opacity: 0;
      visibility: hidden;
      transition-property: transform, opacity, visibility;
      transition-duration: 0.7s;
      transition-timing-function: cubic-bezier(0.445, 0.05, 0.55, 0.95);
    }
    .notification__message h1 {
      font-size: 1.1rem;
      font-weight: 500;
      text-transform: capitalize;
    }
    .notification__message p {
      max-width: 320px;
      font-size: 0.8rem;
      grid-column: 1/-1;
    }
    .notification__message button {
      background: none;
      border: none;
      color: inherit;
      width: 20px;
      height: 20px;
      grid-column: 2/3;
      grid-row: 1/2;
      align-self: center;
    }
    .notification__message button svg {
      display: block;
      width: 100%;
      height: 100%;
    }
    
    /* when the .notification container has a class of .received transition the message into view */
    .notification.received .notification__message {
      transform: translateX(0%);
      opacity: 1;
      visibility: visible;
    }
    /* change the border color according to the different modifiers
    ! for each modifier specify also an svg icon in the background, to highlight the message
    */
    .message--info {
      border-left-color: #90dee9;
      background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle stroke="none" fill="%2390dee9" cx="50" cy="22" r="8"></circle><path fill="none" stroke="%2390dee9" stroke-width="12" stroke-linejoin="round" stroke-linecap="round" d="M 45 40 h 5 v 40 h -5 h 10"></path></svg>'),
        hsl(0, 0%, 100%);
      background-repeat: no-repeat;
      background-size: 35px;
      background-position: 100% 100%;
    }
    .message--success {
      border-left-color: hsl(120, 67%, 74%);
      background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path fill="none" stroke="%2390e990" stroke-width="12" stroke-linejoin="round" stroke-linecap="round" d="M 20 52 l 25 25 l 30 -50"></path></svg>'),
        hsl(0, 0%, 100%);
      background-repeat: no-repeat;
      background-size: 35px;
      background-position: 100% 100%;
    }
    .message--warning {
      border-left-color: hsl(54, 67%, 74%);
      background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path fill="none" stroke="%23e9e090" stroke-width="12" stroke-linejoin="round" stroke-linecap="round" d="M 50 18 v 40"></path><circle stroke="none" fill="%23e9e090" cx="50" cy="78" r="8"></circle></svg>'),
        hsl(0, 0%, 100%);
      background-repeat: no-repeat;
      background-size: 35px;
      background-position: 100% 100%;
    }
    .message--danger {
      border-left-color: hsl(0, 67%, 74%);
      background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><g transform="translate(50 50) rotate(45)"><path fill="none" stroke="%23e99090" stroke-width="12" stroke-linejoin="round" stroke-linecap="round" d="M 0 -30 v 60 z M -30 0 h 60"></path></g></svg>'),
        hsl(0, 0%, 100%);
      background-repeat: no-repeat;
      background-size: 35px;
      background-position: 100% 100%;
    }
    
</style>  
     
 <!-- html structure
div, notification container
svg, bell icon
div, message
-->

<div class="notification">
<!-- the viewBox is 79x79 due to
    - the size of the graphic, 65x75
    - the stroke width, 4x4
    - the empty space included on either side of the graphic to avoid cropping when rotating the bell's shape 10x0
-->
<svg class="notification__bell" viewBox="0 0 79 79" width="79" height="79">
    <!-- group to apply default styles -->
    <g
        stroke="currentColor"
        stroke-width="4">
        <!-- group to translate the graphic enough to avoid cropping of the stroke -->
        <g transform="translate(2 2)">
            <!-- group to center the elements in the 75x75 box allocated to the bell
            ! the group also modifies the transform-origin for the nested elements, which will be rotated from the center of the graphic
            -->
            <g transform="translate(37.5 0)">
                <circle
                    cx="0"
                    cy="8"
                    r="8">
                </circle>
                <!-- circle animated alongside the bell
                ! the rotation occurs from the point described by the parent group
                -->
                <circle
                    class="bell__clapper"
                    cx="0"
                    cy="63"
                    r="12">
                </circle>
                <!-- bell shape
                ! the rotation occurs from the point described by the parent group
                -->
                <path
                    class="bell__body"
                    stroke-linejoin="round"
                    d="M 0 8 a 25 25 0 0 1 25 25 v 17 l 5 6 q 3 7 -6 7 h -48 q -9 0 -6 -7 l 5 -6 v -17 a 25 25 0 0 1 25 -25">
                </path>
            </g>
        </g>
    </g>
</svg>

<!-- message displaying the notification
include modifiers to change the style of the message
message--info
message--success
message--warning
message--danger

! add a button to dismiss the message to the side
-->
<div class="notification__message message--info">
    <h1>Info</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
    <!-- x icon through a path element -->
    <button id="remove" aria-labelledby="button-dismiss">
        <span id="button-dismiss" hidden>Dismiss</span>
        <svg viewBox="0 0 100 100" width="10" height="10">
            <!-- group to style the path -->
            <g
                stroke="currentColor"
                stroke-width="6"
                stroke-linecap="round"
                stroke-linejoin="round"
                fill="none">
                <!-- group to center and rotate the + sign to show an x sign instead -->
                <g transform="translate(50 50) rotate(45)">
                    <!-- path describing two perpendicular lines -->
                    <path
                        d="M 0 -30 v 60 z M -30 0 h 60">
                    </path>
                </g>
            </g>
        </svg>
    </button>
   
<!-- Delete Account -->
    <div >
      <form action="{{route('registration.destroy',$SeCustomer->id)}}" method="POST">
          @csrf
          @method('DELETE')
          <button  account_name={{$SeCustomer->id}} class="delete_account  " ><i class="fa fa-trash" style="color: rgb(248, 0, 0);margin-top: -5px"></i></button>
      </form>
  </div>


</div>
</div>
</div>

<script>

    const btn3 = document.getElementById('btn3');
    const remove = document.getElementById('remove');
    
    btn3.addEventListener('click', () => {
        var h = 1;
       // var account_name =  $(this).attr('account_name');


    // utility function returning a random item from the input array
    const randomItem = arr => arr[Math.floor(Math.random() * arr.length)];
    
    // possible values for the message title and modifier
  //  var h = $(this).attr('name');
    const messageTitle = [  
      'danger',
    ];
    
    // possible values for the body of the message
    // end result of the emmet shortcut p*10>lorem10
    const messageText = [
   'Youre Deleted Your Account Are You Sure ...?!'
   ];
    
    /* logic
    - create a message
    - show the message
    - allow to dismiss the message through the dismiss button
    
    once the message is dismissed the idea is to go through the loop one more time, with a different title and text values
    */
                                         
    const notification = document.querySelector('.notification');
     
    // function called when the button to dismiss the message is clicked
    function dismissMessage() {
        h=0;
      // remove the .received class from the .notification widget
      notification.classList.remove('received');
       
      // call the generateMessage function to show another message after a brief delay
    }
    
    // function showing the message
    function showMessage() {
      // add a class of .received to the .notification container
      notification.classList.add('received');
    
      // attach an event listener on the button to dismiss the message
      // include the once flag to have the button register the click only one time
      const button = document.querySelector('.notification__message button');
      button.addEventListener('click', dismissMessage, { once: true });
    }
    
    // function generating a message with a random title and text
    function generateMessage() {
      // after an arbitrary and brief delay create the message and call the function to show the element
      const delay = Math.floor(Math.random() * 100) + 150;
    
      const timeoutID = setTimeout(() => {
        // retrieve a random value from the two arrays
        const title = randomItem(messageTitle);
        const text = randomItem(messageText);
    
        // update the message with the random values and changing the class name to the title's option
        const message = document.querySelector('.notification__message');
    
        message.querySelector('h1').textContent = title;
        message.querySelector('p').textContent = text;
        message.className = `notification__message message--${title}`;
    
        // call the function to show the message
        showMessage();
        clearTimeout(timeoutID);
      }, delay);
    }
    
    generateMessage();
    
    });
    

    // immediately call the generateMessage function to kickstart the loop
    
</script>

</body>
</html>