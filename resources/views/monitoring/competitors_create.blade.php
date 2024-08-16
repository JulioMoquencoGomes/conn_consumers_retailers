<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Concorrente') }}
        </h2>
    </x-slot>
    <div class="container text-left">
        <form id="form_register_website" action="{{ route('monitoring_competitorssave') }}" method="post">
            @csrf <!-- {{ csrf_field() }} -->

            <div class="row">
                <div class="col">
                    <br/>
                    <br/>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label>Nome:</label><br/>
                    <input type="hidden" id="name" name="name" value=""/>
                    <select class="form-control border border-secondary p-2" id="siteSelected" name="siteSelected" onchange="setInitialKM();">
                        <option value=""></option>
                            @foreach($websites as $website)
                                <option value="{{ $website->id }}">{{ $website->name }}</option>
                            @endforeach
                    </select>
                </div>
                <div class="col">
                    <label>Url do site:</label><br/>
                    <input type="text" class="form-control" id="url" name="url" />
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label>Tráfego orgânico:</label><br/>
                    <input type="text" class="form-control" id="traffic" name="traffic" />
                </div>
                <div class="col">
                    <label>DA:</label><br/>
                    <input type="text" class="form-control" id="da" name="da" />
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label>Valor:</label><br/>
                    <input type="text" class="form-control" id="dr" name="dr" />
                </div>
                <div class="col">
                    <label>SPAM:</label><br/>
                    <input type="text" class="form-control" id="spam" name="spam" />
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label>Print do tráfego orgânico:</label><br/>
                    <input type="text" class="form-control" id="trafficsprint" name="trafficsprint" />
                </div>
                <div class="col">
                    <label>Nicho:</label><br/>
                    <select id="niche" name="niche" class="form-control border border-secondary p-2">
                            @foreach($niches as $niche)
                                <option value="{{ $niche[0] }}">{{ $niche[1] }}</option>
                            @endforeach
                    </select>
                </div>
            </div>

            <input type="hidden" class="form-control" id="website_id" name="website_id" value="0"/>

            <div class="row">
                <div class="col">
                    <label>Velocidade de links inicial:</label><br/>
                    <input type="number" class="form-control" id="start_km" name="start_km" value="0"  disabled />
                </div>
                <div class="col">
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col" id="error_info" style="color: red;">
                <br/>
                <br/>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <br/>
                <button onclick="submitForm();" class="form-control text-bg-success p-3">Cadastrar</button>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    function submitForm(){

        if(!isAllFieldValidated()){
            return false;
        }

        if(!isValidUrl(document.querySelector("#url").value)){
            document.querySelector("#error_info").innerHTML = "<br/>Por favor informe um site valido!<br/>";
            return false;
        }

        var form = document.querySelector("#form_register_website");
        var startKm = document.querySelector("#start_km");
        startKm.disabled=false;
        form.submit();
    }

    function isValidUrl(url){
        if(url.includes('https://') || url.includes('http://') || url.includes('.com') || url.includes('.com.br')){
            return true;
        }
        return false;
    }

    function isAllFieldValidated(){
        
        var textDefault = "<br/>Por favor preencha o campo TEXTFIELD, ele é obrigatório para realizar o cadastro!<br>";

        if(document.querySelector("#name").value=="") {
            document.querySelector("#error_info").innerHTML = textDefault.replace("TEXTFIELD", "Nome");
            return false;
        }

        if(document.querySelector("#url").value=="") {
            document.querySelector("#error_info").innerHTML = textDefault.replace("TEXTFIELD", "Url do site");
            return false;
        }

        if(document.querySelector("#traffic").value=="") {
            document.querySelector("#error_info").innerHTML = textDefault.replace("TEXTFIELD", "Tráfego orgânico");
            return false;
        }

        if(document.querySelector("#da").value=="") {
            document.querySelector("#error_info").innerHTML = textDefault.replace("TEXTFIELD", "DA");
            return false;
        }

        if(document.querySelector("#dr").value=="") {
            document.querySelector("#error_info").innerHTML = textDefault.replace("TEXTFIELD", "DR");
            return false;
        }

        if(document.querySelector("#spam").value=="") {
            document.querySelector("#error_info").innerHTML = textDefault.replace("TEXTFIELD", "SPAM");
            return false;
        }

        if(document.querySelector("#trafficsprint").value=="") {
            document.querySelector("#error_info").innerHTML = textDefault.replace("TEXTFIELD", "Print do tráfego orgânico");
            return false;
        }

        if(document.querySelector("#niche").value=="") {
            document.querySelector("#error_info").innerHTML = textDefault.replace("TEXTFIELD", "Nicho");
            return false;
        }

        return true;
    }


    function setInitialKM(){
        var siteName = document.querySelector("#name"); 
        var siteSelected = document.querySelector("#siteSelected");
        var startKm = document.querySelector("#start_km");
        if(siteSelected.value != ""){
            var mountedUrlName = `/registerwebsite/getname/${siteSelected.value}`;
            $.get(mountedUrlName, {}, function(data){
                siteName.value  = data;
            });
            var mountedUrlQty = `/registerwebsite/km/${siteSelected.value}`;
            $.get(mountedUrlQty, {}, function(data){
                startKm.value  = data;
                document.querySelector("#website_id").value = siteSelected.value;
            });
        }
    }

    window.onload=function(){
        $('#dr').maskMoney({prefix: "R$:"});
    };
</script>