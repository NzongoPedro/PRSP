  <!-- SECÇÃO dasbh-->
  <section class="card dash border-0 rounded-0 shadow-sm" id="dashboard">
      <div class="card-body corpo-dash">
          <!-- CARDS DE INFORMAçÃO -->
          <div class="row">
              <div class="col-3">
                  <div class="shadow-sm alert alert-danger alert-dismissible alertas rounded-0" role="alert" data-aos="fade-left" data-aos-transition="1500" data-aos-durantion="2500">
                      <div class="text-center">
                          <i class="bi bi-people-fill alerta-icon"></i>
                          <h5 class="alerta-titulo">Utentes</h5>
                          <div class="text-center p- badge badge-fill f-primario rounded-5 w-25">
                              <?= $contadores["num_utentes"] ?>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-3">
                  <div class="shadow-sm alert alert-danger alert-dismissible alertas rounded-0" role="alert" data-aos="slide-left" data-aos-transition="500" data-aos-durantion="500">
                      <div class="text-center">
                          <i class="bi bi-person-lines-fill alerta-icon"></i>
                          <h5 class="alerta-titulo">gestores</h5>
                          <div class="text-center p- badge badge-fill f-primario rounded-5 w-25">
                              <?= $contadores["num_gestores"] ?>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-3">
                  <div class="shadow-sm alert alert-danger alert-dismissible alertas rounded-0" role="alert" data-aos="slide-left" data-aos-transition="500" data-aos-durantion="500">
                      <div class="text-center">
                          <i class="bi bi-bank2 alerta-icon"></i>
                          <h5 class="alerta-titulo">postos</h5>
                          <div class="text-center p- badge badge-fill f-primario rounded-5 w-25">
                              <?= $contadores["num_postos"] ?>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-3">
                  <div class="shadow-sm alert alert-danger alert-dismissible alertas rounded-0" role="alert" data-aos="slide-left" data-aos-transition="500" data-aos-durantion="500">
                      <div class="text-center">
                          <i class="bi bi-person-video alerta-icon"></i>
                          <h5 class="alerta-titulo">admin</h5>
                          <div class="text-center p- badge badge-fill f-primario rounded-5 w-25">
                              <?= $contadores["num_adm"] ?>
                          </div>
                      </div>
                  </div>
              </div>
          </div> <!-- FIM CARDS DE INFORMAçÃO -->
          <h5 class="card-title titulo-dash">dashboard</h5>
      </div><!-- Fim card informação -->

  </section><!-- Fim secção dash -->

  <!-- Graficos    -->
  <section class="mt-2">
      <div class="row" data-aos="slide-left" data-aos-transition="500" data-aos-durantion="500">
          <div class="col-lg-6">
              <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">Registros na base de dados - <?= ($contadores["num_utentes"] + $contadores["num_postos"] + $contadores["num_gestores"] + $contadores["num_adm"]) ?> = 100%</h5>

                      <!-- Pie Chart -->
                      <div id="pieChart2" style="height: 400px;" class="echart"></div>

                      <script>
                          document.addEventListener("DOMContentLoaded", () => {
                              echarts.init(document.querySelector("#pieChart2")).setOption({
                                  title: {
                                      text: 'Gráfico do sitema',
                                      subtext: 'Dados reais',
                                      left: 'center'
                                  },
                                  tooltip: {
                                      trigger: 'item'
                                  },
                                  legend: {
                                      orient: 'vertical',
                                      left: 'left'
                                  },
                                  series: [{
                                      name: 'Da Base dados da PRSP',
                                      type: 'pie',
                                      radius: '50%',
                                      data: [{
                                              value: <?= $contadores["num_utentes"] ?>,
                                              name: 'Utentes'
                                          },
                                          {
                                              value: <?= $contadores["num_gestores"] ?>,
                                              name: 'Gestores'
                                          },
                                          {
                                              value: <?= $contadores["num_postos"] ?>,
                                              name: 'Postos'
                                          },
                                          {
                                              value: <?= $contadores["num_adm"] ?>,
                                              name: 'Administradores'
                                          }
                                      ],
                                      emphasis: {
                                          itemStyle: {
                                              shadowBlur: 10,
                                              shadowOffsetX: 0,
                                              shadowColor: 'rgba(0, 0, 0, 0.5)'
                                          }
                                      }
                                  }]
                              });
                          });
                      </script>
                      <!-- End Pie Chart -->

                  </div>
              </div>
          </div>
          <div class="col-lg-6">
              <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">Outra representação</h5>

                      <!-- Pie Chart -->
                      <div id="pieChart" style="height: 400px;"></div>

                      <script>
                          document.addEventListener("DOMContentLoaded", () => {
                              new ApexCharts(document.querySelector("#pieChart"), {
                                  series: [<?= $contadores["num_utentes"] ?>, <?= $contadores["num_postos"] ?>, <?= $contadores["num_gestores"] ?>, <?= $contadores["num_adm"] ?>],
                                  chart: {
                                      height: 350,
                                      type: 'pie',
                                      toolbar: {
                                          show: true
                                      }
                                  },
                                  labels: ['Utentes', 'Gestores', 'Postos', 'Administradores']
                              }).render();
                          });
                      </script>
                      <!-- End Pie Chart -->

                  </div>
              </div>
          </div>
      </div>
  </section>