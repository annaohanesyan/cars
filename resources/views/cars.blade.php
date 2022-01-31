@include('header')

<div class="feturedimage">
		
    @foreach($cars as $car)
        <div class="col-12">
            <div class="col-xs-3">
                <div class="featurecontant">
                    @if($car->image)
                        <img src="../images/{{ $car->image}}" alt="image" style="height:100px;width:80px;margin-left:40%"/>
                    @else
                        <img src="../images/no-image.jpg" alt="image" style="height:100px;width:80px;float:center; margin-left:40%" />
                    @endif
                    <h1>{{ $car->mark_name }}</h1>
                    <p>"Lorem ipsum dolor sit amet, consectetur ,<br>
                            sed do eiusmod tempor incididunt </p>
                    <h2>{{ $car->model_name }}</h2>
                    <button id="btnRM" onclick="rmtxt()">READ MORE</button>
                    <div id="readmore">
                            <h1>Car Name</h1>
                            <p>"Lorem ipsum dolor sit amet, consectetur ,<br>
                            sed do eiusmod tempor incididunt <br>"Lorem ipsum dolor sit amet, consectetur ,<br>
                            sed do eiusmod tempor incididunt"Lorem ipsum dolor sit amet, consectetur1 ,
                            sed do eiusmod tempor incididunt"Lorem ipsum dolor sit amet, consectetur1
                            sed do eiusmod tempor incididunt"Lorem ipsum dolor sit amet, consectetur1<br>
                            </p>
                            <button id="btnRL">READ LESS</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
	</div>