<?php

namespace Prometheus;


use Prometheus\Storage\Adapter;

class Counter extends Collector
{
    const TYPE = 'counter';

    /**
     * @return string
     */
    public function getType()
    {
        return self::TYPE;
    }

    /**
     * @param array $labels e.g. ['status', 'opcode']
     */
    public function inc(array $labels = array())
    {
        $this->incBy(1, $labels);
    }

    /**
     * @param float $count  e.g. 3.14
     * @param array $labels e.g. ['status', 'opcode']
     */
    public function incBy($count, array $labels = array())
    {
        $this->assertLabelsAreDefinedCorrectly($labels);

        $this->storageAdapter->updateCounter(
            array(
                'name' => $this->getName(),
                'help' => $this->getHelp(),
                'type' => $this->getType(),
                'labelNames' => $this->getLabelNames(),
                'labelValues' => $labels,
                'value' => $count,
                'command' => Adapter::COMMAND_INCREMENT_FLOAT
            )
        );
    }
}
