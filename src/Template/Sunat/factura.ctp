<?php
// src/Template/Invoices/add.ctp
echo $this->Html->css('select2.css');
echo $this->Html->script('select2.min');
?>

<style>
    :root {
        --dark-bg: #1a1a1a;
        --darker-bg: #2a2a2a;
        --darkest-bg: #1e1e1e;
        --border-color: #404040;
        --primary-blue: #4a9eff;
        --error-red: #ff4757;
        --text-light: #cccccc;
        --text-muted: #888888;
    }

    .main-container {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        margin: 20px auto;
        max-width: 1200px;
        background: var(--dark-bg);
    }

    .header-section {
        border-bottom: 1px solid var(--border-color);
        padding: 30px;
        background: var(--darker-bg);
    }

    .logo-container {
        width: 80px;
        height: 80px;
        background: var(--border-color);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: bold;
        color: #ffffff;
    }

    .company-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 5px;
        color: #ffffff;
    }

    .company-subtitle {
        font-size: 1.25rem;
        font-weight: 400;
        color: var(--text-light);
    }

    .invoice-info-card {
        border: 2px dashed var(--border-color);
        border-radius: 8px;
        padding: 20px;
        background: rgba(255, 255, 255, 0.02);
    }

    .invoice-info-card h6 {
        font-size: 0.875rem;
        margin-bottom: 8px;
        color: var(--text-light);
    }

    .ruc-number {
        font-size: 1.125rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #ffffff;
    }

    .form-control {
        background: var(--darkest-bg);
        border: 1px solid var(--border-color);
        color: #ffffff;
        border-radius: 6px;
        padding: 10px 15px;
    }

    .form-control:focus {
        background: var(--darker-bg);
        border-color: var(--primary-blue);
        color: #ffffff;
        box-shadow: 0 0 0 0.2rem rgba(74, 158, 255, 0.25);
    }

    .form-control::placeholder {
        color: var(--text-muted);
    }

    label {
        color: var(--text-light);
        font-weight: 500;
        margin-bottom: 8px;
    }

    .items-section {
        background: rgba(255, 255, 255, 0.02);
        border-radius: 8px;
        padding: 20px;
        margin: 30px 0;
    }

    .products-table {
        width: 100%;
        color: #ffffff;
        border-collapse: separate;
        border-spacing: 0 8px;
    }

    .products-table thead th {
        background: var(--darker-bg);
        padding: 12px;
        border: none;
        color: var(--text-light);
        font-weight: 600;
    }

    .products-table tbody tr {
        background: var(--darkest-bg);
        transition: all 0.3s ease;
    }

    .products-table tbody tr:hover {
        background: var(--darker-bg);
        transform: translateX(5px);
    }

    .products-table tbody td {
        padding: 15px 12px;
        border: none;
        color: #ffffff;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state-icon {
        font-size: 3rem;
        color: var(--text-muted);
        margin-bottom: 15px;
    }

    .empty-state-text {
        color: var(--text-light);
        font-size: 1.1rem;
        margin-bottom: 20px;
    }

    .btn-primary {
        background: var(--primary-blue);
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: #6bb6ff;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(74, 158, 255, 0.3);
    }

    .btn-sm-danger {
        background: var(--error-red);
        color: #ffffff;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .btn-sm-danger:hover {
        background: #ff6b7a;
        transform: scale(1.05);
    }

    .totals-card {
        background: var(--darkest-bg);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 25px;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding: 8px 0;
        color: #ffffff;
    }

    .total-row:last-child {
        margin-bottom: 0;
        padding-top: 15px;
        border-top: 2px solid var(--border-color);
        font-weight: 600;
        font-size: 1.2rem;
    }

    .total-label {
        font-weight: 500;
        font-size: 0.95rem;
    }

    .total-value {
        font-family: 'Courier New', monospace;
        font-weight: 600;
        min-width: 100px;
        text-align: right;
    }

    .modal-content {
        background: var(--darker-bg);
        border: 1px solid var(--border-color);
    }

    .modal-header {
        border-bottom: 1px solid var(--border-color);
    }

    .modal-footer {
        border-top: 1px solid var(--border-color);
    }

    .badge-info {
        background: var(--primary-blue);
    }

    .badge-secondary {
        background: var(--border-color);
    }

    .btn-submit-invoice {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #ffffff;
        border: none;
        padding: 12px 30px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }

    .btn-submit-invoice:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }

    .d-flex-all {
        display: flex;
        align-content: center;
        justify-content: space-between;
        align-items: center;
    }

    .custom-switch .custom-control-input {
        left: 0;
        width: 50px;
        height: 24px;
        top: 0;
    }

    .custom-switch .custom-control-label {
        padding-left: 60px;
        padding-top: 2px;
        color: #ffffff;
        margin-bottom: 0;
        font-size: 0.9rem;
    }

    .custom-switch .custom-control-label::before {
        left: 0;
        width: 50px;
        height: 24px;
        background-color: var(--border-color);
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .custom-switch .custom-control-label::after {
        top: 2px;
        left: 2px;
        width: 20px;
        height: 20px;
        background-color: #ffffff;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .custom-switch .custom-control-input:checked~.custom-control-label::before {
        background-color: var(--primary-blue);
    }

    .custom-switch .custom-control-input:checked~.custom-control-label::after {
        transform: translateX(26px);
    }

    .calculation-detail {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-top: 5px;
    }

    .price-breakdown {
        background: rgba(74, 158, 255, 0.1);
        border-left: 3px solid var(--primary-blue);
        padding: 10px;
        margin-top: 10px;
        border-radius: 4px;
    }

    .price-breakdown-item {
        display: flex;
        justify-content: space-between;
        padding: 3px 0;
        font-size: 0.9rem;
    }
</style>

<script>
    $(document).ready(function() {
        $("#startDate").datepicker({
            dateFormat: '<?php echo $this->Gym->dateformat_PHP_to_jQueryUI($this->Gym->getSettings("date_format")); ?>',
            onSelect: function() {
                var date = $('#startDate').datepicker('getDate');
                date.setDate(date.getDate());
            }
        });
    });
</script>

<section class="content">
    <br>
    <div class="col-md-12 box box-default">
        <div class="box-header">
            <section class="content-header">
                <h1>
                    <i class="fa fa-file-invoice"></i>
                    <?php echo __("Nueva Factura Electrónica"); ?>
                    <small><?php echo __("Sistema de Facturación"); ?></small>
                </h1>
            </section>
        </div>
        <hr>

        <div class="main-container">
            <!-- Header -->
            <?= $this->Form->create(null, ['id' => 'invoiceForm', 'type' => 'post']) ?>
            <div class="header-section">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center">
                            <div class="logo-container mr-4">
                                <i class="fa fa-building"></i>
                            </div>
                            <div>
                                <h1 class="company-title mb-1">MONSEFU LOZANO GLORIA</h1>
                                <h2 class="company-subtitle mb-0">CONSUELO</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="invoice-info-card">
                            <h6>R.U.C. N° 10412857955</h6>
                            <div class="ruc-number">FACTURA ELECTRÓNICA</div>
                            <div class="d-flex-all align-items-center justify-content-end">
                                <?= $this->Form->control('serie', [
                                    'type' => 'select',
                                    'label' => false,
                                    'options' => ['F001' => 'F001', 'F002' => 'F002', 'F003' => 'F003'],
                                    'class' => 'custom-select form-control',
                                    'default' => $dataserie,
                                    'style' => 'width: 80px; padding: 8px; margin-right: 8px;',
                                    'id' => 'serie'
                                ]) ?>
                                <span class="mx-2">-</span>
                                <?= $this->Form->control('idserie', [
                                    'label' => false,
                                    'default' => $datasuggestedNumber,
                                    'class' => 'form-control',
                                    'style' => 'width: 120px; padding: 8px;',
                                    'id' => 'idserie',
                                    'readonly' => true
                                ]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-3">

                <!-- Cliente Row -->
                <div class="form-row mb-4">
                    <div class="col-md-6">
                        <?= $this->Form->control('cliente', [
                            'label' => 'Cliente *',
                            'placeholder' => 'Nombre del cliente',
                            'class' => 'form-control',
                            'required' => true
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->control('tipoDoc', [
                            'type' => 'select',
                            'label' => 'Tipo de documento *',
                            'options' => ['RUC' => 'RUC', 'DNI' => 'DNI', 'CE' => 'CE'],
                            'class' => 'form-control',
                            'required' => true,
                            'id' => 'tipoDoc'
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->control('numDoc', [
                            'label' => 'Número de documento *',
                            'placeholder' => 'Número de documento',
                            'class' => 'form-control',
                            'required' => true,
                            'id' => 'numDoc'
                        ]) ?>
                        <small id="doc-error" class="text-danger"></small>
                    </div>
                </div>

                <!-- Dirección -->
                <div class="form-row mb-4">
                    <div class="col-md-12">
                        <?= $this->Form->control('direccion', [
                            'label' => 'Dirección (opcional)',
                            'placeholder' => 'Dirección del cliente',
                            'class' => 'form-control'
                        ]) ?>
                    </div>
                </div>

                <!-- Fecha de Emisión -->
                <div class="form-row mb-4">
                    <div class="col-md-6">
                        <label for="startDate">Fecha de Emisión *</label>
                        <input type="text" autocomplete="off" name="start_date" id="startDate"
                            class="form-control" value="<?= date('d/m/Y') ?>" required>
                    </div>
                </div>

                <!-- Operación y Moneda -->
                <div class="form-row mb-4">
                    <div class="col-md-6">
                        <?= $this->Form->control('tipoOperacion', [
                            'value' => 'Venta Interna',
                            'label' => 'Tipo de Operación *',
                            'placeholder' => 'Tipo de Operación',
                            'class' => 'form-control',
                            'required' => true
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('moneda', [
                            'type' => 'select',
                            'label' => 'Moneda *',
                            'options' => [
                                'PEN' => 'PEN - (S/) Sol',
                                'USD' => 'USD - ($) Dólar',
                                'EUR' => 'EUR - (€) Euro'
                            ],
                            'class' => 'form-control',
                            'default' => 'PEN',
                            'required' => true
                        ]) ?>
                    </div>
                </div>

                <!-- Nota -->
                <div class="form-row mb-5">
                    <div class="col-md-12">
                        <?= $this->Form->control('nota', [
                            'label' => 'Nota (opcional)',
                            'placeholder' => 'Agregar nota a la factura (opcional)',
                            'class' => 'form-control',

                        ]) ?>
                    </div>
                </div>

                <!-- Sección de Productos -->
                <div class="items-section">
                    <div id="emptyState" class="empty-state">
                        <div class="empty-state-icon">
                            <i class="far fa-box-open"></i>
                        </div>
                        <div class="empty-state-text">
                            No hay productos agregados
                        </div>
                        <button type="button" class="btn btn-primary" onclick="openProductModal()">
                            <i class="fas fa-plus mr-2"></i>
                            Agregar Producto
                        </button>
                    </div>

                    <!-- Tabla de Productos -->
                    <div id="productsTable" style="display: none;">
                        <table class="products-table">
                            <thead>
                                <tr>
                                    <th width="8%">Cant.</th>
                                    <th width="40%">Descripción</th>
                                    <th width="13%">P. Unit.</th>
                                    <th width="13%">Subtotal</th>
                                    <th width="13%">IGV</th>
                                    <th width="13%">Total</th>
                                    <th width="10%">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="productsTableBody">
                            </tbody>
                        </table>
                        <div class="text-center mt-3">
                            <button type="button" class="btn btn-primary" onclick="openProductModal()">
                                <i class="fas fa-plus mr-2"></i>
                                Agregar Otro Producto
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Totals Section -->
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <div class="card totals-card">
                            <div class="card-body">
                                <div class="total-row">
                                    <div class="total-label">Subtotal (Base)</div>
                                    <div class="total-value" id="subtotalDisplay">S/ 0.00</div>
                                </div>
                                <div class="total-row">
                                    <div class="total-label">IGV (18%)</div>
                                    <div class="total-value" id="igvDisplay">S/ 0.00</div>
                                </div>
                                <div class="total-row">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="cargoFise"
                                            name="cargo_fise">
                                        <label class="custom-control-label" for="cargoFise">FISE</label>
                                    </div>
                                    <div class="total-value" id="fiseDisplay">S/ 0.00</div>
                                </div>
                                <div class="total-row">
                                    <div class="total-label">TOTAL</div>
                                    <div class="total-value" id="totalDisplay">S/ 0.00</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botón de Guardar -->
                <div class="row mt-4 mb-4">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-submit-invoice" id="submitInvoice">
                            <i class="fas fa-save mr-2"></i>
                            Guardar Factura
                        </button>
                    </div>
                </div>

                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</section>

<!-- Modal de Producto -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white">
                    <i class="fas fa-box mr-2"></i>Agregar Producto
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="productForm">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="productCant">
                                <i class="fas fa-sort-numeric-up mr-2"></i>Cantidad *
                            </label>
                            <input type="number" class="form-control" id="productCant"
                                min="1" step="0.01" placeholder="1.00" required>
                            <div class="invalid-feedback">
                                Por favor ingresa una cantidad válida.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="productCode">
                                <i class="fas fa-barcode mr-2"></i>Código (Opcional)
                            </label>
                            <input type="text" class="form-control" id="productCode"
                                placeholder="Código del producto">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-12 mb-3">
                            <label for="productDesc">
                                <i class="fas fa-align-left mr-2"></i>Descripción *
                            </label>
                            <textarea class="form-control" id="productDesc" rows="2"
                                placeholder="Descripción del producto o servicio" required></textarea>
                            <div class="invalid-feedback">
                                Por favor ingresa una descripción del producto.
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="productPrice">
                                <i class="fas fa-dollar-sign mr-2"></i>Precio Unitario (sin IGV) *
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">S/</span>
                                </div>
                                <input type="number" class="form-control" id="productPrice"
                                    min="0" step="0.01" placeholder="0.00" required>
                            </div>
                            <small class="form-text text-muted">Precio base sin incluir IGV</small>
                            <div class="invalid-feedback">
                                Por favor ingresa un precio válido.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="custom-control custom-checkbox mt-4 pt-2">
                                <input type="checkbox" class="custom-control-input"
                                    id="applyIGV" checked>
                                <label class="custom-control-label text-white" for="applyIGV">
                                    Aplicar IGV (18%) a este producto
                                </label>
                            </div>
                        </div>
                    </div>

                    <div id="calculationBreakdown" class="price-breakdown" style="display: none;">
                        <div class="price-breakdown-item">
                            <span>Subtotal (Precio × Cantidad):</span>
                            <span id="breakdownSubtotal">S/ 0.00</span>
                        </div>
                        <div class="price-breakdown-item">
                            <span>IGV (18%):</span>
                            <span id="breakdownIGV">S/ 0.00</span>
                        </div>
                        <div class="price-breakdown-item" style="font-weight: 600; border-top: 1px solid var(--border-color); padding-top: 5px; margin-top: 5px;">
                            <span>Total:</span>
                            <span id="breakdownTotal">S/ 0.00</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" onclick="addProductToTable()">
                    <i class="fas fa-plus mr-2"></i>Agregar Producto
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Establecer fecha actual por defecto
        const today = new Date();

        // Event listeners para validación
        $('#cliente').on('input', validateCliente);
        $('#numDoc').on('input', validateDocumento);
        $('#tipoDoc').on('change', validateDocumento);

        // Product modal event listeners
        $('#productCant, #productPrice, #applyIGV').on('input change', calculateProductTotal);
        $('#productModal').on('hidden.bs.modal', clearProductForm);

        // Actualizar número de factura al cambiar serie
        $('#serie').on('change', function() {
            updateInvoiceNumber($(this).val());
        });
    });

    // Array para almacenar los productos
    let products = [];
    let productCounter = 1;

    // Función para abrir modal de producto
    function openProductModal() {
        $('#productModal').modal('show');
    }

    // Función para calcular el total del producto
    function calculateProductTotal() {
        const cantidad = parseFloat($('#productCant').val()) || 0;
        const precioBase = parseFloat($('#productPrice').val()) || 0;
        const applyIGV = $('#applyIGV').is(':checked');

        // Calcular subtotal (precio base × cantidad)
        const subtotal = cantidad * precioBase;
        
        // Calcular IGV si aplica
        const igvAmount = applyIGV ? (subtotal * 0.18) : 0;
        
        // Calcular total
        const total = subtotal + igvAmount;

        // Mostrar el desglose
        if (cantidad > 0 && precioBase > 0) {
            $('#calculationBreakdown').show();
            $('#breakdownSubtotal').text('S/ ' + subtotal.toFixed(2));
            $('#breakdownIGV').text('S/ ' + igvAmount.toFixed(2));
            $('#breakdownTotal').text('S/ ' + total.toFixed(2));
        } else {
            $('#calculationBreakdown').hide();
        }
    }

    // Función para limpiar el formulario del producto
    function clearProductForm() {
        $('#productForm')[0].reset();
        $('#calculationBreakdown').hide();
        $('#productForm .form-control').removeClass('is-valid is-invalid');
        $('#applyIGV').prop('checked', true);
    }

    // Función para agregar producto a la tabla
    function addProductToTable() {
        if (!validateProductForm()) {
            return;
        }

        const cantidad = parseFloat($('#productCant').val());
        const codigo = $('#productCode').val().trim();
        const descripcion = $('#productDesc').val().trim();
        const precioBase = parseFloat($('#productPrice').val());
        const applyIGV = $('#applyIGV').is(':checked');

        // Calcular valores
        const subtotal = cantidad * precioBase;
        const igvAmount = applyIGV ? (subtotal * 0.18) : 0;
        const total = subtotal + igvAmount;

        const product = {
            id: productCounter++,
            cantidad: cantidad,
            codigo: codigo,
            descripcion: descripcion,
            precio_base: precioBase,
            subtotal: subtotal,
            igv_amount: igvAmount,
            total: total,
            aplica_igv: applyIGV
        };

        products.push(product);
        updateProductsTable();
        updateTotals();

        $('#productModal').modal('hide');
        showToast('Producto agregado correctamente', 'success');
    }

    // Función para validar el formulario de productos
    function validateProductForm() {
        let isValid = true;

        const cantidad = parseFloat($('#productCant').val());
        const descripcion = $('#productDesc').val().trim();
        const precio = parseFloat($('#productPrice').val());

        if (!cantidad || cantidad <= 0) {
            $('#productCant').addClass('is-invalid');
            isValid = false;
        } else {
            $('#productCant').removeClass('is-invalid').addClass('is-valid');
        }

        if (!descripcion) {
            $('#productDesc').addClass('is-invalid');
            isValid = false;
        } else {
            $('#productDesc').removeClass('is-invalid').addClass('is-valid');
        }

        if (!precio || precio <= 0) {
            $('#productPrice').addClass('is-invalid');
            isValid = false;
        } else {
            $('#productPrice').removeClass('is-invalid').addClass('is-valid');
        }

        return isValid;
    }

    // Función para actualizar la tabla de productos
    function updateProductsTable() {
        const tableBody = $('#productsTableBody');
        const emptyState = $('#emptyState');
        const productsTable = $('#productsTable');

        if (products.length === 0) {
            emptyState.show();
            productsTable.hide();
            return;
        }

        emptyState.hide();
        productsTable.show();
        tableBody.empty();

        products.forEach(function(product) {
            const row = `
            <tr>
                <td>${product.cantidad.toFixed(2)}</td>
                <td>
                    ${product.descripcion}
                    ${product.aplica_igv ? 
                        '<span class="badge badge-info ml-2">+IGV</span>' : 
                        '<span class="badge badge-secondary ml-2">Sin IGV</span>'}
                </td>
                <td>S/ ${product.precio_base.toFixed(2)}</td>
                <td>S/ ${product.subtotal.toFixed(2)}</td>
                <td>S/ ${product.igv_amount.toFixed(2)}</td>
                <td><strong>S/ ${product.total.toFixed(2)}</strong></td>
                <td>
                    <button type="button" class="btn btn-sm-danger" 
                            onclick="removeProduct(${product.id})" title="Eliminar">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
            tableBody.append(row);
        });
    }

    // Función para eliminar producto
    function removeProduct(productId) {
        if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
            products = products.filter(p => p.id !== productId);
            updateProductsTable();
            updateTotals();
            showToast('Producto eliminado', 'info');
        }
    }

    // Función para actualizar totales
    function updateTotals() {
        let subtotalTotal = 0;
        let igvTotal = 0;
        let totalGeneral = 0;

        products.forEach(function(product) {
            subtotalTotal += product.subtotal;
            igvTotal += product.igv_amount;
            totalGeneral += product.total;
        });

        $('#subtotalDisplay').text('S/ ' + subtotalTotal.toFixed(2));
        $('#igvDisplay').text('S/ ' + igvTotal.toFixed(2));
        $('#totalDisplay').text('S/ ' + totalGeneral.toFixed(2));
    }

    // Función para validar cliente
    function validateCliente() {
        const $cliente = $('#cliente');
        const value = $cliente.val().trim();

        if (value.length < 3 && value.length > 0) {
            $cliente.addClass('is-invalid').removeClass('is-valid');
            return false;
        } else if (value.length >= 3) {
            $cliente.addClass('is-valid').removeClass('is-invalid');
            return true;
        } else {
            $cliente.removeClass('is-invalid is-valid');
            return true;
        }
    }

    // Función para validar documento
    function validateDocumento() {
        const tipoDoc = $('#tipoDoc').val();
        const $numDoc = $('#numDoc');
        const value = $numDoc.val().trim();
        const $errorDiv = $('#doc-error');

        if (value.length === 0) {
            $numDoc.removeClass('is-invalid is-valid');
            $errorDiv.text('');
            return true;
        }

        let isValid = false;
        let errorMessage = '';

        switch (tipoDoc) {
            case 'RUC':
                isValid = value.length === 11 && /^\d+$/.test(value);
                errorMessage = 'RUC debe tener 11 dígitos';
                break;
            case 'DNI':
                isValid = value.length === 8 && /^\d+$/.test(value);
                errorMessage = 'DNI debe tener 8 dígitos';
                break;
            case 'CE':
                isValid = value.length >= 8 && value.length <= 12;
                errorMessage = 'CE debe tener entre 8 y 12 caracteres';
                break;
        }

        if (isValid) {
            $numDoc.addClass('is-valid').removeClass('is-invalid');
            $errorDiv.text('');
            return true;
        } else {
            $numDoc.addClass('is-invalid').removeClass('is-valid');
            $errorDiv.text(errorMessage);
            return false;
        }
    }

    // Función para actualizar número de factura
    function updateInvoiceNumber(serie) {
        $.ajax({
            url: '<?= $this->Url->build(['controller' => 'Invoices', 'action' => 'getNextNumber']) ?>',
            type: 'GET',
            data: {
                serie: serie
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#idserie').val(response.number);
                }
            }
        });
    }

    // Función para mostrar notificaciones
    function showToast(message, type = 'info') {
        const alertClass = type === 'success' ? 'alert-success' :
            type === 'error' ? 'alert-danger' : 'alert-info';

        const toast = $(`
        <div class="alert ${alertClass} alert-dismissible fade show position-fixed" 
             style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
            <i class="fas fa-${type === 'success' ? 'check' : 'info'}-circle mr-2"></i>
            ${message}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    `);

        $('body').append(toast);
        setTimeout(() => toast.alert('close'), 3000);
    }

    // Envío del formulario
    $('#invoiceForm').on('submit', function(e) {
        e.preventDefault();

        // Validar que haya productos
        if (products.length === 0) {
            showToast('Debe agregar al menos un producto', 'error');
            return false;
        }

        // Validar campos requeridos
        if (!validateCliente() || !validateDocumento()) {
            showToast('Por favor complete todos los campos requeridos correctamente', 'error');
            return false;
        }

        // Calcular totales finales
        let subtotalTotal = 0;
        let igvTotal = 0;
        let fiseAmount = 0;
        let totalGeneral = 0;

        products.forEach(function(product) {
            subtotalTotal += product.subtotal;
            igvTotal += product.igv_amount;
            totalGeneral += product.total;
        });

        // Preparar datos para enviar
        const formData = new FormData(this);

        // Agregar productos como JSON
        formData.append('items', JSON.stringify(products));

        // Agregar totales
        formData.append('subtotal', subtotalTotal.toFixed(2));
        formData.append('igv_total', igvTotal.toFixed(2));
        formData.append('fise_total', fiseAmount.toFixed(2));
        formData.append('monto_total', totalGeneral.toFixed(2));

        // Mostrar loading
        $('#submitInvoice').prop('disabled', true).html(
            '<i class="fas fa-spinner fa-spin mr-2"></i>Guardando...'
        );

        // Enviar datos
        $.ajax({
            url: $(this).attr('action') || '<?= $this->Url->build(['controller' => 'Invoices', 'action' => 'add']) ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showToast(response.message, 'success');
                    setTimeout(function() {
                        window.location.href = '<?= $this->Url->build(['controller' => 'Invoices', 'action' => 'index']) ?>';
                    }, 1500);
                } else {
                    showToast(response.message, 'error');
                    $('#submitInvoice').prop('disabled', false).html(
                        '<i class="fas fa-save mr-2"></i>Guardar Factura'
                    );
                }
            },
            error: function(xhr) {
                showToast('Error al guardar la factura. Por favor intente nuevamente.', 'error');
                $('#submitInvoice').prop('disabled', false).html(
                    '<i class="fas fa-save mr-2"></i>Guardar Factura'
                );
            }
        });

        return false;
    });
</script>