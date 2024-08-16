<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar site') }}
        </h2>
    </x-slot>
  
    <div class="container text-left">
        <form id="form_register_website" action="{{ route('registerwebsite_update') }}" method="post">
            @csrf <!-- {{ csrf_field() }} -->

            <input type="hidden" id="id" name="id" value="{{ $website->id }}"/>

            <div class="row">
                <div class="col">
                    <br/>
                    <br/>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label>Nome:</label><br/>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $website->name }}"/>
                </div>
                <div class="col">
                    <label>Url do site:</label><br/>
                    <input type="text" class="form-control" id="url" name="url" value="{{ $website->url }}"/>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label>Tráfego orgânico:</label><br/>
                    <input type="text" class="form-control" id="traffic" name="traffic" value="{{ $website->traffic }}"/>
                </div>
                <div class="col">
                    <label>DA:</label><br/>
                    <input type="text" class="form-control" id="da" name="da" value="{{ $website->da }}"/>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label>Valor:</label><br/>
                    <input type="text" class="form-control" id="dr" name="dr" value="{{ $website->dr }}"/>
                </div>
                <div class="col">
                    <label>SPAM:</label><br/>
                    <input type="text" class="form-control" id="spam" name="spam" value="{{ $website->spam }}"/>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label>Print do tráfego orgânico:</label><br/>
                    <input type="text" class="form-control" id="trafficsprint" name="trafficsprint" value="{{ $website->trafficsprint }}"/>
                </div>
                <div class="col">
                    <label>Nicho:</label><br/>
                    <select id="niche" name="niche" class="form-control border border-secondary p-2">
                            @foreach($niches as $niche)
                                @if($niche[0] == $website->niche)
                                    <option selected value="{{ $niche[0] }}">{{ $niche[1] }}</option>
                                @else
                                    <option value="{{ $niche[0] }}">{{ $niche[1] }}</option>
                                @endif
                            @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label>Contato:</label><br/>
                    <input type="number" class="form-control" id="contact" name="contact" value="{{ $website->contact }}"/>
                </div>
                <div class="col">
                    <label>E-mail:</label><br/>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $website->email }}"/>
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
                <button onclick="submitForm();" class="form-control text-bg-success p-3">Atualizar</button>
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

        if(!isValidEmail(document.querySelector("#email").value)){
            document.querySelector("#error_info").innerHTML = "<br/>Por favor informe um e-mail valido!<br/>";
            return false;
        }

        var form = document.querySelector("#form_register_website");
        form.submit();
    }

    function isValidEmail(email) {
        return email.includes('@');
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

        if(document.querySelector("#contact").value=="") {
            document.querySelector("#error_info").innerHTML = textDefault.replace("TEXTFIELD", "Contato");
            return false;
        }

        if(document.querySelector("#email").value=="") {
            document.querySelector("#error_info").innerHTML = textDefault.replace("TEXTFIELD", "E-mail");
            return false;
        }
        return true;
    }

    window.onload=function(){
        $('#dr').maskMoney({prefix: "R$:"});
    };
</script>