<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar site') }}
        </h2>
    </x-slot>

    <div class="container text-left">
        <div class="row">
            <div class="col">
                <br/>
            </div>
        </div>
    </div>
    
    <div class="container text-left">
        <div class="row">
            <div class="col">
                <a href="/registerwebsite" style="text-decoration: underline;">Listar todos os seus sites</a>
            </div>
        </div>
    </div>
    
    <div class="container text-left">
        <form id="form_register_website" action="{{ route('registerwebsite_save') }}" method="post">
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
                    <input type="text" class="form-control" id="name" name="name" />
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

            <div class="row">
                <div class="col">
                    <label>Contato:</label><br/>
                    <input type="number" class="form-control" id="contact" name="contact" />
                </div>
                <div class="col">
                    <label>E-mail:</label><br/>
                    <input type="email" class="form-control" id="email" name="email" />
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