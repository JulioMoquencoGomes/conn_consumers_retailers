<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mercado de sites') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">

        <div class="container text-left">

            <div class="row">
                <div class="col">
                    <h1><big>Filtro de pesquisa:</big></h1>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <br/>
                </div>
            </div>

            <form id="formSearch" method="get">
                <input type="hidden" class="form-control" id="clean" name="clean" value="false" />

                <div class="row">
                    <div class="col">
                        <label>Nome:</label><br/>
                        <input type="text" class="form-control" id="name" name="name" />
                    </div>
                    <div class="col">
                        <label>Tráfego:</label><br/>
                        <input type="text" class="form-control" id="traffic" name="traffic" />
                    </div>
                    <div class="col">
                        <label>DA:</label><br/>
                        <input type="text" class="form-control" id="da" name="da" />
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <br/>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>Valor:</label><br/>
                        <input type="text" class="form-control" id="dr" name="dr" />
                    </div>
                    <div class="col">
                        <label>Nicho:</label><br/>
                        <select id="niche" name="niche" class="form-control border border-secondary p-2">
                            @foreach($niches as $niche)
                                <option value="{{ $niche[0] }}">{{ $niche[1] }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col">
                        <label>&nbsp;</label><br/>
                        <div onclick="submit();" id="btnSubmit" 
                            class="form-control d-flex align-items-center justify-content-center bg-primary text-white">
                            <img width="30" src="/imgs/search2.png"/>
                            <label>&nbsp;Pesquisar</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <br/>
                    </div>
                </div>

            </form>

        </div>

    </div>
    </div>
    </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table width="100%">
                        <tr style="text-align:left;">
                            <th>Nome do site:</th>
                            <th>DA:</th>
                            <th>Valor:</th>
                            <th>Spam:</th>
                            <th>Nicho:</th>
                            <th>Comunicação:</th>
                        </tr>
                        @foreach($websites as $website)
                            <tr style="text-align:left;">
                                <td>{{ $website->name }}</td>
                                <td>{{ $website->da }}</td>
                                <td>{{ $website->dr }}</td>
                                <td>{{ $website->spam }}</td>
                                <td>{{ $niches[($website->niche-1)][1] }}</td>
                                <td>
                                    <button onclick="messageWhatsapp('{{ $website->contact }}', {{ $website->id }})"><img width="30" src="/imgs/whatsapp.png"/></button>
                                    &nbsp;
                                    <button onclick="messageEmail('{{ $website->email }}', {{ $website->id }})"><img width="30" src="/imgs/email.png"/></button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
function messageWhatsapp(number, website_id) {
    var linkWhatsapp = "https://wa.me";
    var fullUrl = linkWhatsapp+"/"+number;
    $.get("{{route('dashboard_actions')}}", { act: 1, website_id: website_id }, function(data){
        setTimeout(function(){
            window.open(fullUrl,'_blank');
        }, 250);
    });
};

function messageEmail(email, website_id) {
    var linkEmail = "mailto:";
    var fullUrl = linkEmail+email;
    $.get("{{route('dashboard_actions')}}", { act: 2, website_id: website_id }, function(data){
        setTimeout(function(){
            window.open(fullUrl,'_blank');
        }, 250);
    });
};

function submit(){
    document.querySelector("#formSearch").submit();
}

window.onload = function() {
    var url = new URL(window.location.href);
    var niche = url.searchParams.get("niche");
    if(niche!=null && niche != ""){
        var txtNiche = document.querySelector("#niche");
        txtNiche.value = niche;
    }

    $('#dr').maskMoney({prefix: "R$:"});
};
</script>