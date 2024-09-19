<?php

namespace App\Validator\Constraints;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class EntityExistsValidator extends ConstraintValidator
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof EntityExists) {
            throw new UnexpectedTypeException($constraint, EntityExists::class);
        }

        $repository = $this->getRepository($constraint->entityClass);
        $entity = $repository->findOneBy([$constraint->field => $value]);

        if (!$entity) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }

    /**
     * @param class-string $entityName
     *
     * @return ObjectRepository<object>
     */
    private function getRepository(string $entityName): ObjectRepository
    {
        return $this->entityManager->getRepository($entityName);
    }
}
