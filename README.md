# To-Do List Manager

A simple web-based To-Do List Manager built with PHP and HTML. It helps users organize and manage their tasks efficiently by allowing them to add, delete, mark tasks as completed, or undo completion. Tasks are stored in PHP sessions, making it a lightweight solution for temporary task management.

## Features
- **Add Tasks**: Add multiple tasks at once by entering them on separate lines.
- **Task Status Management**: Mark tasks as "Completed" or revert them to "Pending."
- **Edit Options**: Delete tasks or undo their completion status.
- **Dynamic Styling**: Buttons and tasks are styled differently based on their status.

## Challenges Faced
1. **Session Management**: Maintaining task data across multiple requests using PHP sessions.
2. **Dynamic Actions**: Handling multiple task states (Add, Complete, Undo, Delete) dynamically with POST requests.
3. **Styling**: Aligning buttons and forms consistently for each task action using CSS.
4. **Form Handling**: Ensuring unique handling of multiple forms on the same page without conflicts.
5. **Error Handling**: Managing edge cases like preventing empty tasks from being added and re-indexing tasks after deletion.

## Usage
1. Clone the repository:
   ```bash
   git clone https://github.com/Naik99/To-Do-List-Manager.git
