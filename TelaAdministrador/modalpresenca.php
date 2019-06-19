<!--MODAL PRESENÇAS-->
      <div class="modal fade" id="PresencaModal" tabindex="-1" role="dialog" aria-labelledby="PresencaModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="PresencaModal">Lançamento de Presenças</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <div class="modal-body">
           <form method="post" action="diario.php">
              <label><b>Código da Turma</b></label>
              <input type="text" list="pesquisaturma" class="form-control" name="codigopesquisaturma" id="codigopesquisaturma" maxlength="5" required><br>
              <datalist id="pesquisaturma" onchange="mostrarturmas(this.value)"></datalist><br>
              <label><b>Data de Aula</b></label>
              <input type="date" name="datadeaula" id="datadeaula" required>
         </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary" value="Cadastrar">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>              
            </div>
          </div>
          </form>
        </div>
      </div>