<?php

$paymentMethods = $this->getMethods();
?>
<div class="container mx-auto m-5">
    <section>
        <div class="container">
                    <h4 class="text-muted text-weight-bold">Payment Methods</h4>
                    <hr><a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('edit','admin_paymentmethod',null,true);?>').resetParam().load();" class="btn btn-success" href="javascript:void(0);">Add Payment Methods</a>
            <br>
            <table class="table">
                <thead>
                    <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!$paymentMethods):?>
                     <tr><td>No records found</td></tr>
                     <?php else: ?>   
                    <?php foreach ($paymentMethods->getData() as $key => $value):?>
                    <tr>
                    <td><?php echo $value->paymentMethodId ?></td>
                    <td><?php echo $value->name ?></td>
                    <td><?php echo $value->code ?></td>
                    <td><?php echo $value->description ?></td>
                    <td><?php echo $this->getStatusName($value); ?></td>
                    <td><?php echo $value->createdAt ?></td>
                    <td>
                        <button class='btn-warning' onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('edit','admin_paymentmethod',['paymentMethodId'=>$value->paymentMethodId],true);?>').resetParam().load();">
                        <i class="fa fa-pencil" aria-hidden="true"></i></button>&nbsp
                        <button class='btn-danger' onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete','admin_paymentmethod',['paymentMethodId'=>$value->paymentMethodId],true);?>').resetParam().load();" >
                        <i class="fa fa-trash" aria-hidden="true"></i></button>
                    </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif;?>
                </tbody>
        </table>
        </div>
    </section>
</div>
