@if(session()->has('message'))
            <div class="class_msg_message">
                <p>
                    {{ session()->get('message') }}
                </p>
            </div> 

        @elseif(session()->has('success'))
            <div class="class_msg_success">
                <p>
                    {{ session()->get('success') }}
                </p>
            </div>
        @elseif(session()->has('error'))
            <div class="class_msg_error">
                <p>
                    {{ session()->get('error') }}
                </p>
            </div>
        @endif