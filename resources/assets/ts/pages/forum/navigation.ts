import { Thread } from "../../types/thread";
import { getThread } from "../../api/thread";
import { registerEnhancement } from "../../enhancements";
import { ajaxNavigation, navigation } from "../../navigation";
import { Offcanvas } from "bootstrap";

const projectId = document.location.pathname.split("/")[2];

const newThreadButton =
    document.querySelector<HTMLAnchorElement>("#new-thread-button");

const newThreadOffcanvasEl = document.querySelector("#new-thread-offcanvas");
const newThreadOffcanvas =
    newThreadOffcanvasEl && Offcanvas.getOrCreateInstance(newThreadOffcanvasEl);

const threadOffcanvasEl = document.querySelector("#thread-offcanvas");
const threadOffcanvas =
    threadOffcanvasEl && Offcanvas.getOrCreateInstance(threadOffcanvasEl);

const showForum = navigation(
    "project.forum",
    `/project/${projectId}/forum`,
    () => {
        threadOffcanvas?.hide();
        threadOffcanvasEl?.classList.remove("show");
    }
);

threadOffcanvasEl?.addEventListener("hide.bs.offcanvas", (e) => {
    if (history.state.name != "project.forum") showForum();
});

newThreadButton?.addEventListener("click", (e) => {
    e.preventDefault();
    showForum();

    if (newThreadOffcanvas) {
        const style = getComputedStyle(newThreadOffcanvasEl);

        if (style.position == "fixed") {
            newThreadOffcanvas.show();
        }
    }
});

const threadTitleEl = document.querySelector<HTMLElement>("#thread-title");
const threadContentEl = document.querySelector<HTMLElement>("#thread-content");

const showThreadOffcanvas = () => {
    if (threadOffcanvas) {
        const style = getComputedStyle(threadOffcanvasEl);

        if (style.position == "fixed") {
            threadOffcanvas.show();
        }
    }

    threadOffcanvasEl?.classList.add("show");
};

const showThread = ajaxNavigation(
    "project.thread",
    getThread,
    ({ title, content }: Thread) => {
        showThreadOffcanvas();
        threadOffcanvasEl?.classList.remove("loading");

        threadTitleEl && (threadTitleEl.innerText = title);
        threadContentEl && (threadContentEl.innerHTML = content);
    },
    (e) => {
        showThreadOffcanvas();
        threadOffcanvasEl?.classList.remove("loading");
    },
    () => {
        showThreadOffcanvas();
        threadOffcanvasEl?.classList.add("loading");
    }
);

registerEnhancement({
    selector: ".thread[data-thread-id]",
    onattach: (el) => {
        const threadId = el.dataset.threadId ?? "";
        const a = el.querySelector<HTMLAnchorElement>("a.stretched-link");

        a?.addEventListener("click", (e) => {
            e.preventDefault();
            showThread(`/project/${projectId}/thread/${threadId}`, threadId);
        });
    },
});