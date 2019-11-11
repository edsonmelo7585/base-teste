@extends('layouts.app', ["current_page" => "Proprietários"])

@section('body')
<div class="card border">
    <div class="card-body">
        <h5 class="card-title">Cadastro de Proprietários</h5>
        <table class="table table-ordered table-hover" id="tabelaproprietarios">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <button class="btn btn-sm btn-primary" role="button" onClick="novoProprietario()">Novo proprietario</a>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="dlgproprietarios">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="formproprietario">
                <div class="modal-header">
                    <h5 class="modal-title">Novo Proprietário</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" class="form-control">
                    <div class="form-group">
                        <label for="nomeproprietario" class="control-label">Nome do proprietario</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nomeproprietario" placeholder="Nome do proprietario">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script type="text/javascript">
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
    })
    function novoProprietario() {
        $('#id').val('');
        $('#nomeproprietario').val('');
        // $('#dlgproprietarios').modal('show');
        $('#dlgproprietarios').show();
    }

    // function buscarproprietario(id){
    //     var nome = '';
    //     $.getJSON('/api/proprietarioss', function(data) {
    //         for(i=0;i<data.length;i++) {
    //             nome = data[i].nome;
    //         }
    //     });
    //     return nome;
    // }

    function montarLinha(p) {
        var linha = "<tr>" +
            "<td>" + p.id + "</td>" +
            "<td>" + p.nome + "</td>" +
            "<td>" +
              '<button class="btn btn-sm btn-primary" onclick="editar(' + p.id + ')"> Editar </button> ' +
              '<button class="btn btn-sm btn-danger" onclick="remover(' + p.id + ')"> Apagar </button> ' +
            "</td>" +
            "</tr>";
        return linha;
    }

    function editar(id) {
        $.getJSON('/api/proprietarios/'+id, function(data) {
            console.log(data);
            $('#id').val(data.id);
            $('#nomeproprietario').val(data.nome);
            $('#dlgproprietarios').show();
        });
    }

    function remover(id) {
        $.ajax({
            type: "DELETE",
            url: "/api/proprietarios/" + id,
            context: this,
            success: function() {
                console.log('Apagou OK');
                linhas = $("#tabelaproprietarios>tbody>tr");
                e = linhas.filter( function(i, elemento) {
                    return elemento.cells[0].textContent == id;
                });
                if (e)
                    e.remove();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function carregarProprietarios() {
        $.getJSON('/api/proprietarios', function(proprietarios) {
            for(i=0;i<proprietarios.length;i++) {
                linha = montarLinha(proprietarios[i]);
                $('#tabelaproprietarios>tbody').append(linha);
            }
        });
    }

    function criarProprietario() {
        prop = {
            nome: $("#nomeproprietario").val()
        };
        $.post("/api/proprietarios", prop, function(data) {
            console.log(data);
            proprietario = JSON.parse(data);
            linha = montarLinha(proprietario);
            $('#tabelaproprietarios>tbody').append(linha);
        });
    }
    function salvarProprietario() {
        proprietario = {
            id : $("#id").val(),
            nome: $("#nomeproprietario").val()
        };
        $.ajax({
            type: "PUT",
            url: "/api/proprietarios/" + proprietario.id,
            context: this,
            data: proprietario,
            success: function(data) {
                proprietario = JSON.parse(data);
                linhas = $("#tabelaproprietarios>tbody>tr");
                e = linhas.filter( function(i, e) {
                    return ( e.cells[0].textContent == proprietario.id );
                });
                if (e) {
                    e[0].cells[0].textContent = proprietario.id;
                    e[0].cells[1].textContent = proprietario.nome;
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    $("#formproprietario").submit( function(event){
        event.preventDefault();
        if ($("#id").val() != '')
            salvarProprietario();
        else
            criarProprietario();

        $("#dlgproprietarios").hide();
    });

    $(function(){
        carregarProprietarios();
    })

</script>
@endsection
