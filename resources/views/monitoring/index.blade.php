<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
var tasks = [];
</script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Monitoramento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="row">
                        <div class="col">
                            Selecione o site:
                        </div>
                        <div class="col">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <select id="site_id" onchange="researchCompetitors();" class="form-control border border-secondary p-2">
                                <option value=""></option>
                                @foreach($websites as $website)
                                    @if($website->id == ($website_selected != null ? $website_selected->id : 0) )
                                        <option selected value="{{ $website->id }}">{{ $website->name }}</option>
                                    @else
                                        <option value="{{ $website->id }}">{{ $website->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <div onclick="registerCompetitor('/monitoring/competitors/create');"
                                class="form-control d-flex align-items-center justify-content-center bg-success text-white">
                                <img src="/imgs/add2.png" width="30" style="display: inline;"/>&nbsp;<label>Cadastrar concorrente</label>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    @if($website_selected != null)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="row">
                        <div class="col" style="padding-left: 30px;">
                            <br/>
                            <h2><big>Site monitorado:</big></h2>
                        </div>
                    </div>
                    <div class="p-6 text-gray-900">

                        <table width="100%">
                            <tr style="text-align:left;">
                                <th>Nome do site:</th>
                                <th>Tráfego:</th>
                                <th>DA:</th>
                                <th>Valor:</th>
                                <th>Spam:</th>
                                <th>Nicho:</th>
                                <th>Quantidade:</th>
                            </tr>

                            <tr>
                                <td>{{ $website_selected->name }}</td>
                                <td>{{ $website_selected->traffic }}</td>
                                <td>{{ $website_selected->da }}</td>
                                <td>{{ $website_selected->dr }}</td>
                                <td>{{ $website_selected->spam }}</td>
                                <td>{{ $niches[($website_selected->niche-1)][1] }}</td>
                                <td>{{ $qty_links }}</td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="row">
                    <div class="col" style="padding-left: 30px;">
                        <br/>
                        <h2><big>Concorrentes do mês de {{ $name_month }}:</big></h2>
                    </div>
                </div>
                <div class="p-6 text-gray-900">

                    <table width="100%">
                        <tr style="text-align:left;">
                            <th>Nome do site:</th>
                            <th>DA:</th>
                            <th>Valor:</th>
                            <th>Spam:</th>
                            <th>Nicho:</th>
                            <th>Km inicial:</th>
                            <th>Km final:</th>
                            <th>Opções</th>
                        </tr>
                    @foreach($competitors as $competitor)
                            <tr style="text-align:left;">
                                <td>{{ $competitor->name }}</td>
                                <td>{{ $competitor->da }}</td>
                                <td>{{ $competitor->dr }}</td>
                                <td>{{ $competitor->spam }}</td>
                                <td>{{ $niches[($competitor->niche-1)][1] }}</td>
                                <td>{{ $competitor->start_km }}</td>
                                <td id="qty_links_{{$competitor->id}}">
                                    <script>
                                        var competitor_id = "{{ $competitor->id }}";
                                        var website_id = "{{ $competitor->website_id }}";
                                        if(website_id != null && website_id != "")
                                        {
                                            var mountedUrlQty = "/registerwebsite/km/"+website_id;
                                            tasks.push([ "#qty_links_"+competitor_id,  mountedUrlQty ]);
                                        }
                                    </script>
                                </td>
                                <td>
                                    <a href="/monitoring/competitors/edit/{{ $competitor->id }}">
                                        <img src="/imgs/edit.png" width="30" style="display: inline;"/>
                                    </a>
                                    <a href="javascript:confirmRemove('/monitoring/competitors/delete/{{ $competitor->id }}');">
                                        <img src="/imgs/delete.png" width="30" style="display: inline;"/>
                                    </a>
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
function researchCompetitors(){
    var siteId = document.querySelector("#site_id").value;
    window.open("/monitoring/"+siteId,'_self');
}

function confirmRemove(url) {
    Swal.fire({
        title: "Voce tem certeza?",
        text: "Não será possivel reverter isso!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim",
        cancelButtonText: "Não"
        }).then((result) => {
        if (result.isConfirmed) {
            window.open(url, '_self');
        }
    });
}

function registerCompetitor(url){
    var siteId = document.querySelector("#site_id").value;
    if(siteId != "" && siteId != "0"){
        window.open(url+"?site_selected="+siteId, '_self');
    }
    else{
        Swal.fire({
            title: "Falha ao criar um novo concorrente!",
            text: "Necessita selecionar um site!",
            icon: "error"
        });
    }
}

window.onload = function(){
    tasks.forEach(function(task){
        $.get(task[1], {}, function(data) {
            document.querySelector(task[0]).innerHTML=data;
        });
    });
};
</script>