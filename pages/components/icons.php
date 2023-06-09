<?php

function icons($nameIcon, $size, $color) {
    // if($nameIcon === 'calendar') {
    //     return (
          
    //     );
    // }

    $size = strval($size).'px';

    if(empty($size)) $size = 'none';
    if(empty($color)) $color = '#000';

    switch($nameIcon) {
        case 'calendar':
            echo '
                <svg 
                width="18" 
                height="20" 
                style="
                    max-width:'.$size.';
                    max-height:'.$size.';
                "
                viewBox="0 0 18 20" 
                fill="none" 
                xmlns="http://www.w3.org/2000/svg">
                <path d="M6 9H4V11H6V9ZM10 9H8V11H10V9ZM14 9H12V11H14V9ZM16 2H15V0H13V2H5V0H3V2H2C0.89 2 0.00999999 2.9 0.00999999 4L0 18C0 18.5304 0.210714 19.0391 0.585786 19.4142C0.960859 19.7893 1.46957 20 2 20H16C17.1 20 18 19.1 18 18V4C18 2.9 17.1 2 16 2ZM16 18H2V7H16V18Z" 
                fill="'.$color.'"/>
                </svg>            
            ';
            break;
        case 'setting':
            echo '
                <svg 
                width="20" 
                height="20" 
                style="max-width:'.$size.'; max-height:'.$size.';"
                viewBox="0 0 20 20" 
                fill="none" 
                xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.5225 20H7.88252C7.65445 20 7.43322 19.9221 7.25552 19.7792C7.07782 19.6362 6.95433 19.4368 6.90552 19.214L6.49852 17.33C5.95558 17.0921 5.44075 16.7946 4.96352 16.443L3.12652 17.028C2.90908 17.0973 2.67447 17.0902 2.46164 17.0078C2.24881 16.9254 2.07057 16.7727 1.95652 16.575L0.132521 13.424C0.0196664 13.2261 -0.0226964 12.9958 0.0123634 12.7708C0.0474233 12.5457 0.15783 12.3392 0.325521 12.185L1.75052 10.885C1.68572 10.2961 1.68572 9.70189 1.75052 9.113L0.325521 7.816C0.157592 7.66177 0.0470356 7.45507 0.01197 7.22978C-0.0230956 7.00449 0.0194104 6.77397 0.132521 6.576L1.95252 3.423C2.06657 3.22532 2.24481 3.07259 2.45764 2.99019C2.67047 2.90778 2.90508 2.90066 3.12252 2.97L4.95952 3.555C5.20352 3.375 5.45752 3.207 5.71952 3.055C5.97252 2.913 6.23252 2.784 6.49852 2.669L6.90652 0.787C6.95509 0.564198 7.07835 0.364688 7.25587 0.221549C7.43338 0.0784098 7.65449 0.000239966 7.88252 0H11.5225C11.7506 0.000239966 11.9717 0.0784098 12.1492 0.221549C12.3267 0.364688 12.4499 0.564198 12.4985 0.787L12.9105 2.67C13.4528 2.90927 13.9674 3.20668 14.4455 3.557L16.2835 2.972C16.5008 2.90292 16.7352 2.91017 16.9478 2.99256C17.1604 3.07495 17.3385 3.22753 17.4525 3.425L19.2725 6.578C19.5045 6.985 19.4245 7.5 19.0795 7.817L17.6545 9.117C17.7193 9.70589 17.7193 10.3001 17.6545 10.889L19.0795 12.189C19.4245 12.507 19.5045 13.021 19.2725 13.428L17.4525 16.581C17.3385 16.7787 17.1602 16.9314 16.9474 17.0138C16.7346 17.0962 16.5 17.1033 16.2825 17.034L14.4455 16.449C13.9687 16.8003 13.4542 17.0975 12.9115 17.335L12.4985 19.214C12.4498 19.4366 12.3264 19.6359 12.1489 19.7788C11.9714 19.9218 11.7504 19.9998 11.5225 20ZM9.69852 6C8.63766 6 7.62024 6.42143 6.87009 7.17157C6.11995 7.92172 5.69852 8.93913 5.69852 10C5.69852 11.0609 6.11995 12.0783 6.87009 12.8284C7.62024 13.5786 8.63766 14 9.69852 14C10.7594 14 11.7768 13.5786 12.5269 12.8284C13.2771 12.0783 13.6985 11.0609 13.6985 10C13.6985 8.93913 13.2771 7.92172 12.5269 7.17157C11.7768 6.42143 10.7594 6 9.69852 6Z" 
                    fill="'.$color.'"/>
                </svg>            
            ';
            break;
        case 'exit':
            echo '
                <svg 
                class="submenu_img exit-icon" 
                width="16" height="16" 
                style="max-width:'.$size.'; max-height:'.$size.';"
                viewBox="0 0 16 16" fill="none" 
                xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.77778 16H14.2222C15.2027 16 16 15.2027 16 14.2222V1.77778C16 0.797333 15.2027 0 14.2222 0H1.77778C0.797333 0 0 0.797333 0 1.77778V7.112H6.22044V3.55556L11.5538 8L6.22044 12.4444V8.88978H0V14.2222C0 15.2027 0.797333 16 1.77778 16Z" 
                    fill="'.$color.'"/>
                </svg>
            ';
            break;
        case 'arrow':
            echo '
                <svg 
                class="arrow_img" 
                width="9" height="6" 
                style="max-width:'.$size.'; max-height:'.$size.';"
                viewBox="0 0 9 6" 
                fill="none" 
                xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.83824 1.62443L5.32362 5.1609C5.10794 5.37791 4.75827 5.37791 4.54259 5.1609L1.02797 1.62443C0.812292 1.40741 0.812292 1.05556 1.02797 0.838543C1.24364 0.621527 1.59332 0.621527 1.809 0.838543L4.60959 3.65655L5.25662 3.65655L8.05722 0.838543C8.27289 0.621527 8.62257 0.621527 8.83824 0.838543C9.05392 1.05556 9.05392 1.40741 8.83824 1.62443Z" 
                    fill="'.$color.'"/>
                </svg>
            ';
            break;
        case 'RUB':
            echo '
                <svg 
                class="payment-icon" 
                width="373" height="410" 
                style="max-width:'.$size.'; max-height:'.$size.';"
                viewBox="0 0 373 410" 
                fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M217.856 261.141H0.121094V191.889H215.461C231.693 191.889 244.998 189.494 255.376 184.704C265.754 179.915 273.404 173.129 278.327 164.348C283.25 155.567 285.711 145.189 285.711 133.214C285.711 121.506 283.25 110.929 278.327 101.482C273.404 92.0355 265.887 84.5183 255.775 78.9302C245.663 73.3421 233.024 70.5481 217.856 70.5481H144.014V409.025H58.1971V0.298096H217.856C250.187 0.298096 277.861 6.08573 300.879 17.661C324.029 29.1033 341.725 44.8031 353.966 64.7604C366.206 84.5848 372.26 107.07 372.127 132.216C372.26 158.56 366.073 181.378 353.566 200.67C341.06 219.962 323.231 234.864 300.081 245.375C276.93 255.886 249.522 261.141 217.856 261.141ZM233.223 287.485V356.737H0.121094V287.485H233.223Z" 
                    fill="'.$color.'"/>
                </svg> 
            ';
            break;
        case 'USD':
            echo '
                <svg 
                class="payment-icon" 
                width="325" height="512" 
                style="max-width:'.$size.'; max-height:'.$size.';"
                viewBox="0 0 325 512" fill="none" 
                xmlns="http://www.w3.org/2000/svg">
                    <path d="M149.035 511.116V0.207275H181.765V511.116H149.035ZM235.849 168.847C234.253 152.748 227.401 140.242 215.293 131.327C203.186 122.413 186.754 117.956 165.998 117.956C151.895 117.956 139.987 119.952 130.275 123.943C120.562 127.802 113.111 133.19 107.922 140.109C102.866 147.027 100.338 154.877 100.338 163.658C100.072 170.976 101.602 177.362 104.929 182.817C108.388 188.272 113.111 192.996 119.098 196.987C125.086 200.846 132.004 204.238 139.854 207.165C147.704 209.959 156.086 212.354 165 214.35L201.722 223.131C219.551 227.123 235.916 232.445 250.817 239.097C265.719 245.75 278.624 253.932 289.535 263.645C300.445 273.357 308.893 284.8 314.88 297.971C321.001 311.143 324.127 326.244 324.26 343.275C324.127 368.288 317.741 389.975 305.101 408.336C292.595 426.564 274.5 440.733 250.817 450.845C227.267 460.824 198.861 465.813 165.599 465.813C132.603 465.813 103.864 460.757 79.3832 450.646C55.0352 440.534 36.0092 425.566 22.3051 405.741C8.73407 385.784 1.61593 361.103 0.950684 331.699H84.5721C85.5035 345.404 89.4284 356.846 96.347 366.026C103.399 375.074 112.779 381.926 124.487 386.582C136.328 391.106 149.7 393.368 164.601 393.368C179.237 393.368 191.943 391.239 202.72 386.981C213.63 382.724 222.079 376.803 228.066 369.219C234.053 361.636 237.047 352.921 237.047 343.075C237.047 333.895 234.319 326.178 228.864 319.925C223.542 313.671 215.692 308.349 205.314 303.959C195.07 299.568 182.496 295.577 167.595 291.984L123.09 280.808C88.6301 272.426 61.4216 259.321 41.4642 241.492C21.5068 223.663 11.5946 199.648 11.7277 169.446C11.5946 144.699 18.1806 123.078 31.4855 104.584C44.9235 86.0906 63.3508 71.6547 86.7674 61.2769C110.184 50.899 136.794 45.7101 166.597 45.7101C196.932 45.7101 223.409 50.899 246.027 61.2769C268.779 71.6547 286.474 86.0906 299.114 104.584C311.754 123.078 318.273 144.499 318.672 168.847H235.849Z" 
                    fill="'.$color.'"/>
                </svg>
            ';
            break;
        case 'EUR':
            echo '
                <svg 
                class="payment-icon"  
                width="339" height="421" 
                style="max-width:'.$size.'; max-height:'.$size.';"
                viewBox="0 0 339 421" fill="none" 
                xmlns="http://www.w3.org/2000/svg">
                    <path d="M287.003 146.998L267.245 190.704H0.415039L16.5805 146.998H287.003ZM248.885 230.619L227.131 275.324H0.415039L16.5805 230.619H248.885ZM338.892 37.8307L306.961 106.085C301.639 102.36 295.186 98.3016 287.602 93.9109C280.151 89.3873 271.569 85.5954 261.857 82.5353C252.277 79.3421 241.633 77.7455 229.925 77.7455C211.431 77.7455 195.332 82.4022 181.628 91.7156C167.924 101.029 157.28 115.531 149.696 135.223C142.246 154.914 138.52 180.193 138.52 211.061C138.52 242.194 142.246 267.54 149.696 287.098C157.28 306.524 167.924 320.826 181.628 330.007C195.332 339.054 211.431 343.578 229.925 343.578C241.633 343.578 252.277 342.048 261.857 338.988C271.436 335.928 279.818 332.269 287.003 328.011C294.321 323.754 300.441 319.829 305.364 316.236L337.695 384.491C323.193 396.465 306.761 405.512 288.4 411.633C270.039 417.62 250.548 420.613 229.925 420.613C195.066 420.613 164.199 412.364 137.323 395.866C110.58 379.235 89.6246 355.353 74.4569 324.219C59.2893 292.953 51.7055 255.233 51.7055 211.061C51.7055 167.022 59.2893 129.302 74.4569 97.9025C89.6246 66.5028 110.58 42.4874 137.323 25.8563C164.199 9.09206 195.066 0.709961 229.925 0.709961C251.346 0.709961 271.17 3.90313 289.398 10.2895C307.626 16.6759 324.124 25.8563 338.892 37.8307Z" 
                    fill="'.$color.'"/>
                </svg>
            ';
            break;
        case 'transactionCard':
            echo '
                <svg 
                width="65" height="51" 
                style="max-width:'.$size.'; max-height:'.$size.';"
                viewBox="0 0 65 51" 
                fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M62.6469 0.508057H3.21833C1.95405 0.508057 0.932617 1.52368 0.932617 2.78078V14.1444H64.9326V2.78078C64.9326 1.52368 63.9112 0.508057 62.6469 0.508057ZM0.932617 48.2353C0.932617 49.4924 1.95405 50.5081 3.21833 50.5081H62.6469C63.9112 50.5081 64.9326 49.4924 64.9326 48.2353V20.3944H0.932617V48.2353ZM42.2898 35.1671C42.2898 34.8546 42.5469 34.599 42.8612 34.599H54.6469C54.9612 34.599 55.2183 34.8546 55.2183 35.1671V40.2808C55.2183 40.5933 54.9612 40.849 54.6469 40.849H42.8612C42.5469 40.849 42.2898 40.5933 42.2898 40.2808V35.1671Z" 
                    fill="'.$color.'"/>
                </svg>
            ';
            break;
        case 'profile':
            echo '
                <svg 
                width="39" height="39" 
                viewBox="0 0 39 39" fill="none" 
                style="max-width:'.$size.'; max-height:'.$size.';"
                xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.1209 19.33C24.2746 19.33 27.6418 15.9628 27.6418 11.8092C27.6418 7.65552 24.2746 4.28833 20.1209 4.28833C15.9673 4.28833 12.6001 7.65552 12.6001 11.8092C12.6001 15.9628 15.9673 19.33 20.1209 19.33Z" 
                    fill="'.$color.'"/>
                    <path d="M34.7668 32.1946V34.0748C34.7668 34.5735 34.5687 35.0517 34.2161 35.4043C33.8635 35.7569 33.3853 35.955 32.8866 35.955H6.56368C6.06502 35.955 5.58678 35.7569 5.23417 35.4043C4.88156 35.0517 4.68347 34.5735 4.68347 34.0748V32.1946C4.68347 29.2026 5.87203 26.3332 7.98767 24.2175C10.1033 22.1019 12.9727 20.9133 15.9647 20.9133H23.4856C26.4775 20.9133 29.347 22.1019 31.4626 24.2175C33.5783 26.3332 34.7668 29.2026 34.7668 32.1946Z" 
                    fill="'.$color.'"/>
                </svg>
            
            ';
            break;
        case 'search':
            echo '
                <svg 
                width="25" height="25" 
                viewBox="0 0 25 25" fill="none" 
                style="max-width:'.$size.'; max-height:'.$size.';"
                xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.32812 10.5312C2.32812 6.00079 6.00079 2.32812 10.5312 2.32812C15.0617 2.32812 18.7344 6.00079 18.7344 10.5312C18.7344 15.0617 15.0617 18.7344 10.5312 18.7344C6.00079 18.7344 2.32812 15.0617 2.32812 10.5312ZM10.5312 0.328125C4.89622 0.328125 0.328125 4.89622 0.328125 10.5312C0.328125 16.1663 4.89622 20.7344 10.5312 20.7344C12.9912 20.7344 15.2478 19.8638 17.0099 18.414C17.0344 18.4452 17.061 18.4752 17.0898 18.504L22.9023 24.3165C23.2928 24.707 23.926 24.707 24.3165 24.3165C24.707 23.926 24.707 23.2928 24.3165 22.9023L18.504 17.0898C18.4752 17.061 18.4452 17.0344 18.414 17.0099C19.8638 15.2478 20.7344 12.9912 20.7344 10.5312C20.7344 4.89622 16.1663 0.328125 10.5312 0.328125Z" 
                    fill="'.$color.'"/>
                </svg>            
            ';
            break;
        case 'upload':
            echo '
                <svg 
                width="234" height="278" 
                style="max-width:'.$size.'; max-height:'.$size.';"
                viewBox="0 0 234 278" fill="none" 
                xmlns="http://www.w3.org/2000/svg">
                    <path d="M40.333 110.667H66.833V194C66.833 203.167 74.333 210.667 83.4997 210.667H150.166C159.333 210.667 166.833 203.167 166.833 194V110.667H193.333C208.166 110.667 215.666 92.6665 205.166 82.1665L128.666 5.66655C127.124 4.12149 125.293 2.8957 123.277 2.05934C121.261 1.22298 119.099 0.79248 116.916 0.79248C114.734 0.79248 112.572 1.22298 110.556 2.05934C108.54 2.8957 106.708 4.12149 105.166 5.66655L28.6663 82.1665C18.1663 92.6665 25.4997 110.667 40.333 110.667ZM0.333008 260.667C0.333008 269.833 7.83301 277.333 16.9997 277.333H217C226.166 277.333 233.666 269.833 233.666 260.667C233.666 251.5 226.166 244 217 244H16.9997C7.83301 244 0.333008 251.5 0.333008 260.667Z" 
                    fill="'.$color.'"/>
                </svg>        
            ';
            break;
        case 'arrowUp':
            echo '
                <svg 
                width="68" height="56" 
                viewBox="0 0 68 56" fill="none" 
                style="max-width:'.$size.'; max-height:'.$size.'; transform: rotate(0deg)"
                xmlns="http://www.w3.org/2000/svg">
                    <path d="M34 0L-7.39527e-07 56H68L34 0Z" 
                    fill="'.$color.'"/>
                </svg>        
            ';
            break;
        case 'arrowDown':
            echo '
                <svg 
                width="68" height="56" 
                viewBox="0 0 68 56" fill="none" 
                style="max-width:'.$size.'; max-height:'.$size.'; transform: rotate(180deg)"
                xmlns="http://www.w3.org/2000/svg">
                    <path d="M34 0L-7.39527e-07 56H68L34 0Z" 
                    fill="'.$color.'"/>
                </svg>        
            ';
            break;
        case 'arrowDefault':
            echo '
                <svg 
                width="114" height="22" 
                style="max-width:'.$size.'; max-height:'.$size.';"
                viewBox="0 0 114 22" fill="none" 
                xmlns="http://www.w3.org/2000/svg">
                    <rect width="114" height="22" rx="6" 
                    fill="'.$color.'"/>
                </svg>            
            ';
            break;
        default: 
            echo '
                <svg 
                width="491" 
                height="491" 
                style="max-width:'.$size.'; max-height:'.$size.';"
                viewBox="0 0 491 491" 
                fill="none" 
                xmlns="http://www.w3.org/2000/svg">
                    <path d="M490.375 435.958V55.0417C490.375 25.1125 465.888 0.625 435.958 0.625H55.0417C25.1125 0.625 0.625 25.1125 0.625 55.0417V435.958C0.625 465.888 25.1125 490.375 55.0417 490.375H435.958C465.888 490.375 490.375 465.888 490.375 435.958ZM161.154 299.372L218.292 368.21L302.638 259.648C308.079 252.574 318.962 252.574 324.404 259.92L419.905 387.255C421.421 389.277 422.344 391.68 422.571 394.196C422.798 396.712 422.32 399.242 421.19 401.502C420.06 403.762 418.323 405.662 416.174 406.99C414.025 408.319 411.549 409.022 409.022 409.022H82.7942C71.3667 409.022 65.1088 395.962 72.1829 386.983L139.932 299.917C145.101 292.843 155.44 292.57 161.154 299.372Z" 
                    fill="#BAC3CC"/>
                </svg>            
            ';
    }
}