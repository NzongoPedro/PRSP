<!-- Modal -->
<div class="modal fade" id="modalPostoNovo" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" id="form">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPostoNovoTitle">Adicionar Posto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="m-auto">
                    <P class="alert alert-dark">
                        <span><b>token:</b> <b class="text-danger token"></b></span>
                        <br>
                        Copie e anote o seu token num local seguro.
                    </P>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Nome ou designação do posto</label>
                        <input type="text" name="nomePosto" id="nomePosto" class="form-control" placeholder="Escreva o nome exato do posto" autocomplete="off" required />
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-0">
                        <label for="emailBackdrop" class="form-label">E-mail</label>
                        <input type="text" name="emailPosto" id="emailPosto" class="form-control" placeholder="xxxx@xxx.xx" autocomplete="off" required />
                    </div>
                    <div class="col mb-0">
                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Categoria</label>
                            <select class="form-select" name="categoriaPosto" id="exampleFormControlSelect1" aria-label="Default select example">
                                <option selected>Escolha a categoria</option>
                                <option value="1">Conservatória</option>
                                <option value="2">Notário</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-0">
                        <div class="mb-3">
                            <label for="exampleFormControlSelect2" class="form-label">Município</label>
                            <select class="form-select" name="muicipioPosto" id="exampleFormControlSelect2" aria-label="Default select example">
                                <option selected>Escolha o município</option>
                                <option>Belas</option>
                                <option>Cazenga</option>
                                <option>Luanda</option>
                            </select>
                        </div>
                    </div>
                    <div class="col -mb-3">
                        <label for="html5-url-input" class="col-form-label">Link de localização</label>
                        <input class="form-control" name="linkPosto" type="url" value="https://themeselection.com" id="html5-url-input" autocomplete="off" required />
                    </div>
                </div>
            </div>
            <input type="hidden" name="id-gestor" value="<?= $id_gestor ?>">
            <input type="hidden" name="token" value="">
            <div class="text-center resposta container"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="submit" class="btn btn-danger">Adicionar</button>
            </div>
        </form>
    </div>
</div>