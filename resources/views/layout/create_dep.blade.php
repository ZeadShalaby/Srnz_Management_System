<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/message.css')}}">

    <title>messages_sucess</title>
</head>
<body>
    <div class="container">
        @yield('dep_create')
        
    </div>
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
        <div class="notification__message message--info" id="success_msg" style="display: none">
          <h1 style="color: rgb(0, 0, 0);font-weight:bold;">Info</h1>
          <p style="font-weight:bold;font-size:17px">Lorem ipsum dolor sit amet consectetur adipisicing.</p>
         <span style="color: rgb(255, 106, 0);font-weight:bold;font-size:15px">My Dear :<span style="color: rgb(255, 106, 0);font-weight:bold;font-size:15px">@if(isset($SeAdmin)) {{$SeAdmin->name}}</span></span>
            @endif
                       
         </span></span>
      
            <!-- x icon through a path element -->
            <button aria-labelledby="button-dismiss">
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
          
    <!------>
    
        </div>
    </div>
    
    <script>
    
     
    
    // utility function returning a random item from the input array
    const randomItem = arr => arr[Math.floor(Math.random() * arr.length)];
    
    // possible values for the message title and modifier
    const messageTitle = [
      
      
      'success',
     
    ];
    // possible values for the body of the message
    // end result of the emmet shortcut p*10>lorem10
    const messageText = [
    'Create Departments Successfully.....'
        
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
      const delay = Math.floor(Math.random() * 10) + 100;
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
    
    
    // immediately call the generateMessage function to kickstart the loop
    
    </script>

<!----------------------    --------------------->

</body>
</html>