import './bootstrap';
import React from "react";
import { createRoot } from "react-dom/client";

const App: React.FC = () => {
  return <h1>Hello Kanban</h1>;
};

const container = document.getElementById("app");
if (container) {
  const root = createRoot(container);
  root.render(<App />);
}
