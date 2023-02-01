@props(['user'])
<div class="col d-flex justify-content-center m-0">
    <div class="card p-3">

        <div class="w-100">
            
           <h4 class="mb-0 mt-0">{{$user->name}} {{$user->surname}}</h4>
           <span>{{__(ucfirst($user->userType->name))}}</span>

           <div class="p-2 mt-2 bg-primary d-flex justify-content-between rounded text-white stats">

            <div class="d-flex flex-column">

                <span class="articles">Articles</span>
                <span class="number1">38</span>
                
            </div>

            <div class="d-flex flex-column">

                <span class="followers">Followers</span>
                <span class="number2">980</span>
                
            </div>


            <div class="d-flex flex-column">

                <span class="rating">Rating</span>
                <span class="number3">8.9</span>
                
            </div>
               
           </div>


           <div class="button mt-2 d-flex flex-row align-items-center">

            <button class="btn btn-sm btn-outline-primary w-100">Chat</button>
            <button class="btn btn-sm btn-primary w-100 ml-2">Follow</button>

               
           </div>


        </div>

            
        </div>
        
</div>
