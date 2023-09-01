<div class="modal fade" id="modalServico" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="card mb-4 border-0 shadow-none">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Adicionar serviços ou documentos</h5>
                        <small class="text-muted float-end text-danger">Preencha o formulário</small>
                    </div>
                    <div class="card-body">
                        <form class="" id="formServico">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nome do documento <span class="cor-primario">*</span></label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="border-p input-group-text"><i class="bx bx-archive"></i></span>
                                        <input type="text" name="servico-nome" class="border-p form-control form-control-lg" id="basic-icon-default-fullname" placeholder="Digite o nome do documento" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Tempo de duração <span class="cor-primario">*</span></label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-company2" class="border-p input-group-text"><i class="bx bx-time"></i></span>
                                        <input type="text" name="servico-tempo-duracao" id="basic-icon-default-company" class="border-p form-control form-control-lg" placeholder="O tempo de espera para a aquisição do documento" aria-label="O tempo de espera para a aquisição do documento" aria-describedby="basic-icon-default-company2" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-email">preço <span class="cor-primario">*</span></label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="border-p input-group-text"><i class="bx bx-money"></i></span>
                                        <input type="text" name="servico-preco" id="basic-icon-default-email" class="border-p form-control form-control-lg" placeholder="25.000,00" aria-label="john.doe" aria-describedby="basic-icon-default-email2" />
                                        <span id="basic-icon-default-email2" class="border-p input-group-text">Kz</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 form-label" for="basic-icon-default-phone">Validade do documento</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-phone2" class="border-p input-group-text"><i class="bx bx-phone"></i></span>
                                        <input type="text" name="servico-validade" id="basic-icon-default-phone" class="border-p form-control form-control-lg" placeholder="Período de validade após a aquisição" aria-label="Período de validade após a aquisição" aria-describedby="basic-icon-default-phone2" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 form-label" for="basic-icon-default-message">Requisitos <span class="cor-primario">*</span></label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-message2" class="border-p input-group-text"><i class="bx bx-comment"></i></span>
                                        <textarea id="basic-icon-default-message" name="servico-requisitos" class="border-p form-control form-control-lg" placeholder="Escreva todos os requisitos ou documentos necessários para a aquisição deste documento ou serviço" aria-label="Escreva todos os requisitos ou documentos necessários para a aquisição deste documento ou serviço" aria-describedby="basic-icon-default-message2" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <div class="text-center respostaServico"></div>
                                    <button type="submit" class="btn btn-lg w-100 f-primario text-white">Adicionar</button>
                                </div>
                            </div>
                            <input type="hidden" name="id-posto" value="<?= $posto->idposto ?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>