# ServerRules

A PocketMine-MP plugin to list your rules in one command.

1) List your rules in the config like so
```yml
rules:
- "Rule 1"
- "Rule 2"
- "Rule 3"
and so on...
```
2) Reload the server
```
Reloading server...
Reload complete.
```
3) Issue /rules to test
```
--- Showing rules page 1 of 1 (/rules <page>) ---
- Rule 1
- Rule 2
- Rule 3
```

## Commands
| Command | Usage | Description |
| ------- | ----- | ----------- |
| `/rules` | `/rules [page]` | Server rules. |

## Permissions
```yaml
rules:
 default: true
```
