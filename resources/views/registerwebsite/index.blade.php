<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sites') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">

                    <table width="100%">
                        <tr style="text-align:left;">
                            <th>Nome do site:</th>
                            <th>Tráfego:</th>
                            <th>DA:</th>
                            <th>Valor:</th>
                            <th>Spam:</th>
                            <th>Nicho:</th>
                            <th>Opções</th>
                        </tr>
                    @foreach($websites as $website)
                            <tr style="text-align:left;">
                                <td>{{ $website->name }}</td>
                                <td>{{ $website->traffic }}</td>
                                <td>{{ $website->da }}</td>
                                <td>{{ $website->dr }}</td>
                                <td>{{ $website->spam }}</td>
                                <td>{{ $niches[($website->niche-1)][1] }}</td>
                                <td>
                                    <a href="/registerwebsite/edit/{{ $website->id }}">
                                        <img src="/imgs/edit.png" width="30" style="display: inline;"/>
                                    </a>
                                    <a href="javascript:confirmRemove('/registerwebsite/delete/{{ $website->id }}');">
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
</script>