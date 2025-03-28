

<?php $__env->startSection('title', ucfirst($page)); ?>

<?php $__env->startPush('styles'); ?>
    <?php echo app('Illuminate\Foundation\Vite')(['file' => "resources/css/{$page}.css"]); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <br />
    <br />
    <br />
    <br />
    <div class="container">
        <h1>Liste des Entreprises</h1>

        <!-- Vérifier si des entreprises existent -->
        <?php if($entreprises->isEmpty()): ?>
            <div class="alert alert-warning">
                Aucune entreprise trouvée.
            </div>
        <?php else: ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom de l'entreprise</th>
                        <th>Description</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Candidatures</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $entreprises; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entreprise): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td> <!-- Affiche le numéro d'ordre de l'entreprise -->
                            <td><?php echo e($entreprise->nom); ?></td>
                            <td><?php echo e(Str::limit($entreprise->description, 50)); ?>

                                <!-- Limite la description à 50 caractères -->
                            </td>
                            <td><?php echo e($entreprise->telephone); ?></td>
                            <td><?php echo e($entreprise->email); ?></td>
                            <td><?php echo e($entreprise->candidatures); ?></td>
                            <td>
                                <!-- Lien vers la page de détails de l'entreprise -->
                                <a href="<?php echo e(route('entreprises.show', ['id' => $entreprise->Id_Entreprise])); ?>"
                                    class="btn btn-outline">Voir</a>


                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-outline-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Programmation\bloc\ProjetWeb\resources\views/entreprises/liste.blade.php ENDPATH**/ ?>