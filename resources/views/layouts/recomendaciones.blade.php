<div class="panel panel-default">
    <div class="panel-heading">
        Recomendaciones para tí
    </div>

    <div class="panel-body">
        @if (count($recomendations) > 0)
            <table class="table table-striped disc-table">  
                <thead>
                    <th>&nbsp;</th>
                    <th>Disco</th>
                    <!--<th>Artista</th>-->
                    <!--<th>Artista</th>-->
                    <!--<th>Grupo</th>-->
                    <th>&nbsp;</th>
                </thead>

                <tbody>
                    @foreach ($recomendations as $rec)
                        <tr>
                            <td>
                                <div><img src="{{ url('/').$rec->img_path }}" alt="{{ $rec->name }}" height="50" width="50"></div>
                            </td>
                            <td class="table-text">
                                <div>{!! Html::linkAction('DiscController@discs_details', $rec->name, array($rec->id)) !!}</div>
                            </td>
                            <td>
                                <form action="{{ url('/user/addtocart/'.$rec->id) }}" method="GET">
                                    <button type="submit" id="add-rec-{{ $rec->id }}" class="btn btn-primary btn-mini">
                                        <i class="fa fa-shopping-cart"></i> Añadir
                                    </button>
                                </form>
                            
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>