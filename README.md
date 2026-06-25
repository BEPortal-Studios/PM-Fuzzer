# PM-Fuzzer

PM-Fuzzer is a PHP library for PocketMine-MP that automatically tests every command registered on your server by injecting extreme, unexpected and malformed arguments, then reports any anomaly, unhandled exception or unexpected behavior it finds.

---

## Installation

```bash
composer require portalstudio/pm-fuzzer
```

---

## How it works

PM-Fuzzer takes a command and a list of payloads, one per argument, and systematically tests every combination of extreme values on each argument position, while keeping the other arguments at a safe neutral value.

For each test, it records whether the command crashed, which value caused it, at which position, and what exception was thrown.

---

## Usage

```php
use portalstudio\pmfuzzer\PMFuzzer;
use portalstudio\pmfuzzer\payload\NumberPayload;
use portalstudio\pmfuzzer\payload\StringPayload;
use portalstudio\pmfuzzer\sender\FuzzCommandSender;

$report = PMFuzzer::fuzz(new FuzzCommandSender(), $command,
    new StringPayload(), new NumberPayload());

foreach ($report->getFailures() as $entry) {
    echo $entry->getCommandName();
    echo $entry->getPayloadType();
    echo $entry->getFuzzedValue();
    echo $entry->getArgPosition();
    echo $entry->getException()->getMessage();
}
```

---

## Available Payloads

| Payload | Tests |
|---|---|
| `NumberPayload` | System limits, powers of two, floats, overflows, invalid numeric strings |
| `StringPayload` | Empty strings, long strings, special characters, unicode, injections |
| `BooleanPayload` | Classic booleans, numeric booleans, word booleans, invalid values |

---

## Limitations

Commands that check `instanceof Player` on the sender will return early before the arguments are even processed. In that case, consider passing a real online player as the sender:

```php
PMFuzzer::fuzz($realPlayer, $command, new NumberPayload());
```

---